import { $request } from "./RequestService";
import { notifier } from "./NorifierService";
import { translation } from "./TranslationService";
import debounce from "lodash.debounce";
import { SendRequestParams } from "./Contracts/SendRequestParams";
import { HttpStatus } from "./Enumns/HttpStatus";
import { AxiosResponse } from "axios";
import { InputType } from "./Enumns/InputTypes";
import { InertiaForm } from "@inertiajs/vue3";
import { FormRules } from "./Contracts/FormRules";

class FormService {
    debouncedFetchCities: Function;
    debouncedFetchStreets: Function;
    debouncedFetchCountries: Function;
    debouncedFetchNovaPoshtaCities: Function;
    debouncedFetchNovaPoshtaDepartments: Function;
    private context?: any;
    public static phoneLength = 12;
    public static phoneCountryCode = 38;
    public static phoneConfirmationCodeLength = 6;

    constructor(context = null) {
        this.context = context;
        this.debouncedFetchCities = debounce(this.fetchCities, 300);
        this.debouncedFetchStreets = debounce(this.fetchStreets, 300);
        this.debouncedFetchCountries = debounce(this.fetchCountries, 300);
        this.debouncedFetchNovaPoshtaDepartments = debounce(
            this.fetchNovaPoshtaDepartments,
            300
        );
        this.debouncedFetchNovaPoshtaCities = debounce(
            this.fetchNovaPoshtaCities,
            300
        );
    }

    static clearPhone(phone: string): string {
        const cleared = phone.replace(/\D/g, ""); // Removes all non-digit characters
        if (cleared.length === this.phoneLength - 2) {
            return `${this.phoneCountryCode} ${cleared}`; // prepend country code if it's not there
        }
        return cleared;
    }

    static clearPhoneCode(code: string): string {
        return code.replace(/\D/g, "");
    }

    static validateUploadAvatar(file) {
        const fileType = file.type;
        const allowedTypes = ["image/jpeg", "image/png", "image/gif"];

        if (!allowedTypes.includes(fileType)) {
            return "Please select a valid image file (JPEG, PNG, or GIF).";
        }

        const fileSize = file.size;
        const maxSize = 5 * 1024 * 1024; // Maximum file size in bytes (e.g., 5MB)

        if (fileSize > maxSize) {
            return "The selected file exceeds the maximum allowed size.";
        }

        return null;
    }

    static isInputType(value: string): boolean {
        return Object.values(InputType).includes(value as InputType);
    }

    sendRequestDecorator(
        search: string | null = "",
        loading: Function | null = null,
        callback: Function = () => {},
        params: SendRequestParams = {
            non_cyrillic: false,
        }
    ) {
        try {
            if ((!search || search.length === 0) && loading !== null) {
                throw new Error();
            }

            if (
                !params.non_cyrillic &&
                loading !== null &&
                this.containsNonCyrillicCharacters(search)
            ) {
                throw new Error(
                    translation.__(
                        "profile.address.messages.errors.cyrillic_text"
                    )
                );
            }
            return callback();
        } catch (error) {
            if (error.message) {
                notifier.notifyError(error.message);
            }
        } finally {
            if (loading) {
                loading(false);
            }
        }
    }

    containsNonCyrillicCharacters(text) {
        const cyrillicRegex = /[^\u0400-\u04FF]/g;
        return cyrillicRegex.test(text);
    }

    async fetchCities(search, loading) {
        return await this.sendRequestDecorator(search, loading, async () => {
            const response = await $request.axios.get(
                route("api.city-search"),
                {
                    params: {
                        city: search,
                    },
                }
            );

            if (response.data.success) {
                return response.data.data[0].Addresses;
            } else if (response.data.errors.length > 0) {
                throw new Error(response.data.errors.join(","));
            }
        });
    }

    async fetchNovaPoshtaCities(search, loading) {
        return await this.sendRequestDecorator(search, loading, async () => {
            const response = await $request.axios.get(
                route("api.search-nova-poshta-city"),
                {
                    params: {
                        city: search,
                    },
                }
            );
            if (response.data.success) {
                return response.data.data;
            } else if (response.data.errors.length > 0) {
                throw new Error(response.data.errors.join(","));
            }
        });
    }

    async fetchNovaPoshtaDepartments(search, loading, cityRef) {
        return await this.sendRequestDecorator(
            search,
            loading,
            async () => {
                const response: AxiosResponse = await $request.axios.get(
                    route("api.search-nova-poshta-departments"),
                    {
                        params: {
                            warehouseId: search,
                            cityRef: cityRef.ref,
                        },
                    }
                );
                if (response.status === HttpStatus.OK) {
                    return response.data.data;
                }
            },
            {
                non_cyrillic: true,
            }
        ).catch((error) => {
            if (error.message) {
                notifier.notifyError(error.message);
            }
        });
    }

    async fetchStreets(search, loading, cityRef) {
        return await this.sendRequestDecorator(search, loading, async () => {
            const response = await $request.axios.get(
                route("api.street-search"),
                {
                    params: {
                        street: search,
                        cityRef: cityRef,
                    },
                }
            );

            if (response.data.success) {
                return response.data.data[0].Addresses;
            } else if (response.data.errors.length > 0) {
                throw new Error(response.data.errors.join(","));
            }
        });
    }

    async fetchCountries() {
        return await this.sendRequestDecorator(
            null,
            null,
            async () => {
                const response: AxiosResponse = await $request.axios.get(
                    route("api.countries")
                );
                if (response.status === HttpStatus.OK) {
                    return response.data;
                }
            },
            {
                non_cyrillic: true,
            }
        ).catch((error) => {
            if (error.message) {
                notifier.notifyError(error.message);
            }
        });
    }

    static isValidPhone(phone) {
        return this.clearPhone(phone).length === this.phoneLength;
    }

    static validateShippingForm(
        formData: InertiaForm<any>,
        formRules: FormRules
    ) {
        for (let option in formData) {
            this.validateShippingFormField(formData, formRules, option);
        }

        return formData.hasErrors;
    }

    static validateShippingFormField(
        formData: InertiaForm<any>,
        formRules: FormRules,
        fieldName: string
    ) {
        formData.clearErrors(fieldName);

        let value = formData[fieldName];

        if (formRules.required.includes(fieldName) && !formData[fieldName]) {
            formData.setError(
                fieldName,
                translation.__("checkout.form.errors.field_is_required")
            );
        } else if (
            formRules.email.includes(fieldName) &&
            !this.isValidEmail(value)
        ) {
            formData.setError(
                fieldName,
                translation.__("checkout.form.errors.email_format")
            );
        } else if (
            formRules.phone.includes(fieldName) &&
            !this.isValidPhone(value)
        ) {
            formData.setError(
                fieldName,
                translation.__("checkout.form.errors.not_valid_phone_format")
            );
        } else if (
            value &&
            formRules.confirm_phone_code.includes(fieldName) &&
            !this.isValidPhoneCode(value)
        ) {
            formData.setError(
                fieldName,
                translation.__("checkout.form.errors.phone_code_is_not_valid")
            );
        }
    }

    public static isValidPhoneCode(code: string) {
        return code && code.match(/^\d{2}-\d{2}-\d{2}$/);
    }

    public static isValidEmail(value: any) {
        return value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/);
    }
}

export default FormService;
