<template>
    <Head :title="__('profile.meta-title')"/>
    <section class="user-dashboard section">
        <Modal v-model="showAddressForm">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-center mb-4 mt-4">
                            {{
                                __('profile.address.modal.title')
                            }}
                        </h3>
                    </div>
                    <div class="col-lg-12 mb-3 mt-3 px-md-5">
                        <form
                            @submit.prevent
                        >
                            <div class="form-group">
                                <label for="addressCity">{{ __('profile.address.form.labels.city') }}</label>
                                <DropdownSearch
                                    v-model="addressForm.city"
                                    :options="cityOptions"
                                    label="present"
                                    :placeholder="__('profile.address.form.placeholder.city')"
                                    @search="fetchCities"/>
                            </div>
                            <div class="form-group">
                                <label for="addressStreet">{{ __('profile.address.form.labels.street') }}</label>
                                <DropdownSearch
                                    v-model="addressForm.street"
                                    :options="streetOptions"
                                    label="present"
                                    :disabled="streetDisabled"
                                    :placeholder="__('profile.address.form.placeholder.street')"
                                    @search="fetchStreets"/>
                            </div>
                            <div class="form-group">
                                <label for="reviewText">{{ __('profile.address.form.labels.house') }}</label>
                                <TextInput
                                    id="house"
                                    v-model="addressForm.house"
                                    :placeholder="__('profile.address.form.placeholder.house')"
                                    type="text"
                                    :disabled="houseDisabled"
                                    class="form-control"
                                    required
                                    autofocus
                                />
                            </div>
                            <div class="form-group">
                                <label for="reviewText">{{ __('profile.address.form.labels.flat') }}</label>
                                <TextInput
                                    id="flat"
                                    v-model="addressForm.flat"
                                    :placeholder="__('profile.address.form.placeholder.flat')"
                                    type="text"
                                    class="form-control"
                                    :disabled="flatDisabled"
                                />
                            </div>
                            <div class="form-group">
                                <CheckboxComponent v-model="addressForm.default">
                                    {{ __('profile.address.form.labels.default_address') }}
                                </CheckboxComponent>
                            </div>
                            <div
                                class="p-4 d-flex justify-content-between"
                            >
                                <a
                                    href=""
                                    class="btn btn-dark"
                                    @click.prevent="closeAddressForm"
                                >{{ __('product.review-data.btn.back') }}</a>
                                <a
                                    href=""
                                    class="btn btn-primary"
                                    @click.prevent="submitForm"
                                >{{ __('product.review-data.btn.save') }}</a
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Modal>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <DashboardMenu/>
                    <div class="user-dashboard">
                        <div class="table-responsive">
                            <table class="table w-100">
                                <thead>
                                <tr>
                                    <th>{{ __('profile.address.city') }}</th>
                                    <th>{{ __('profile.address.street') }}</th>
                                    <th>{{ __('profile.address.house') }}</th>
                                    <th>{{ __('profile.address.flat') }}</th>
                                    <th>{{ __('profile.address.default') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(address, key) in user.addresses" :key="key">
                                    <td>{{ address.city.present }}</td>
                                    <td>{{ address.street.present }}</td>
                                    <td>{{ address.house || '-' }}</td>
                                    <td>{{ address.flat || '-' }}</td>
                                    <td>
                                        <i v-if="address.default" class="ti-check-box" aria-hidden="true"></i>
                                        <template v-else>-</template>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button
                                                type="button" class="btn btn-sm btn-outline-primary"
                                                @click="showUpdateAddressForm(address)">
                                                <i class="ti-pencil" aria-hidden="true"></i>
                                            </button>
                                            <button
                                                type="button" class="btn btn-sm btn-outline-primary"
                                                @click="removeAddress(address.id)"><i
                                                class="ti-close" aria-hidden="true"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="user.addresses.length === 0">
                                    <td class="text-center" colspan="6"> {{ __('profile.address.no_addresses') }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <a class="btn btn-primary btn-sm" href="" @click.prevent="addAddress">
                                    <i class="ti-plus mr-1" aria-hidden="true"></i>
                                    {{ __('product.address.add-address') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import DashboardMenu from '@/Components/Profile/DashboardMenu.vue';
import Modal from '@/Components/UI/Modal.vue';

import {useForm, Head} from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import DropdownSearch from '@/Components/UI/DropdownSearch.vue';
import CheckboxComponent from '@/Components/UI/CheckboxComponent.vue';
import FormService from '@/Services/FormService.ts';

export default {
    name: 'Address',
    components: {
        CheckboxComponent,
        DropdownSearch,
        TextInput,
        Modal,
        Head,
        DashboardMenu,
    },
    layout: [BaseLayout],
    data: () => {
        return {
            cityOptions: [],
            streetOptions: [],
            updateAddressId: null,
            showAddressForm: false,
            addressForm: useForm({
                city: null,
                street: null,
                house: null,
                flat: null,
                default: false,
            }),
        };
    },
    computed: {
        formService() {
            return new FormService();
        },
        streetDisabled() {
            return !this.addressForm.city;
        },
        houseDisabled() {
            return !this.addressForm.city || !this.addressForm.street;
        },
        flatDisabled() {
            return !this.addressForm.city || !this.addressForm.street || !this.addressForm.house;
        },
    },
    watch: {
        showAddressForm() {
            console.log(this.addressForm);
        },
    },
    methods: {
        showUpdateAddressForm(address) {
            this.addressForm.city = address.city;
            this.addressForm.street = address.street;
            this.addressForm.house = address.house;
            this.addressForm.flat = address.flat;
            this.addressForm.default = address.default;
            this.updateAddressId = address.id;
            this.openAddressForm();
        },
        updateAddress(id) {
            this.addressForm.put(this.route('profile.address.update-address', id), {
                onSuccess: () => {
                    this.addressForm.reset();
                    this.closeAddressForm();
                    this.notifySuccess(this.__('profile.address.messages.address_updated'));
                },
            });
        },
        openAddressForm() {
            this.showAddressForm = true;
        },
        closeAddressForm() {
            this.showAddressForm = false;
        },
        removeAddress(id) {
            this.$request.send('delete', this.route('profile.address.remove-address', id), {
                onSuccess: () => this.notifySuccess(this.__('profile.address.messages.address_deleted')),
            });
        },
        saveAddress() {
            this.addressForm.post(this.route('profile.address.add-address'), {
                onSuccess: () => {
                    this.addressForm.reset();
                    this.notifySuccess(this.__('profile.address.messages.address_added'));
                },
            });
            this.closeAddressForm();
        },
        fetchStreets(search, loading) {
            this.formService.fetchStreets(search, loading, this.addressForm.city.ref).then((data) => {
                this.streetOptions = data;
            });
        },
        fetchCities(search, loading) {
            this.formService.fetchCities(search, loading).then((data) => {
                this.cityOptions = data;
            });
        },
        addAddress() {
            this.openAddressForm();
            this.addressForm.reset();
        },
        submitForm() {
            this.addressForm.clearErrors();
            if (this.updateAddressId) {
                this.updateAddress(this.updateAddressId);
            } else {
                this.saveAddress();
            }
        },
    },
};
</script>

<style scoped>
@import "vue-select/dist/vue-select.css";

</style>
