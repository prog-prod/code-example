<template>
    <Head :title="__('profile.meta-title')"/>
    <section class="user-dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <DashboardMenu/>
                    <div class="dashboard-wrapper dashboard-user-profile">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img class="media-object user-img" :src="avatarURL" alt="Image">
                                    <p class="uploaded-avatar-name">{{ uploadedAvatarName }}</p>
                                    <div
                                        id="validationServer03Feedback"
                                        class="invalid-feedback"
                                        :class="{'d-block': errors.avatar}">
                                        {{ errors.avatar }}
                                    </div>
                                    <a
                                        href="/profile-details#" class="btn btn-sm mt-3 d-block"
                                        @click.prevent="openFileInput">{{ __('profile.choose_image') }}</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="media-body">
                                    <form action="#" enctype="multipart/form-data" @submit.stop.prevent>
                                        <input
                                            ref="fileInput"
                                            class="d-none"
                                            type="file"
                                            @input="form.avatar = $event.target.files[0]"
                                            @change="handleFileUpload">
                                        <a
                                            v-tooltip.left="__('buttons.edit')"
                                            href="#"
                                            class="edit-info-btn"
                                            @click.prevent="toggleEditForm">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <ul class="user-profile-list">
                                            <li>
                                                <span>{{ __('profile.full_name') }}:</span>
                                                <p v-if="!editForm">{{ fullName || '-' }}</p>
                                                <div v-else class="d-md-inline-flex">
                                                    <div class="p-1">
                                                        <label
                                                            for="form-last-name"
                                                            class="form-label">{{ __('profile.last_name') }}</label><br>
                                                        <input
                                                            id="form-last-name" v-model="form.last_name"
                                                            class="form-control"
                                                            :class="{'is-invalid': form.errors.last_name}"
                                                            aria-describedby="Provide your last name"
                                                            type="text">
                                                        <div
                                                            v-if="form.errors.last_name"
                                                            id="validationServer03Feedback"
                                                            class="invalid-feedback">
                                                            {{ form.errors.last_name }}
                                                        </div>
                                                    </div>
                                                    <div class="p-1">
                                                        <label
                                                            for="form-first-name"
                                                            class="form-label">{{
                                                                __('profile.first_name')
                                                            }}</label><br>
                                                        <input
                                                            id="form-first-name" v-model="form.first_name"
                                                            class="form-control"
                                                            :class="{'is-invalid': form.errors.first_name}"
                                                            aria-describedby="Provide your first name"
                                                            type="text">
                                                        <div
                                                            v-if="form.errors.first_name"
                                                            id="validationServer03Feedback"
                                                            class="invalid-feedback">
                                                            {{ form.errors.first_name }}
                                                        </div>
                                                    </div>
                                                    <div class="p-1">
                                                        <label
                                                            for="form-middle-name"
                                                            class="form-label">{{
                                                                __('profile.middle_name')
                                                            }}</label><br>
                                                        <input
                                                            id="form-first-name" v-model="form.middle_name"
                                                            class="form-control form-control-sm"
                                                            :class="{'is-invalid': form.errors.middle_name}"
                                                            aria-describedby="Provide your middle name"
                                                            type="text">
                                                        <div
                                                            v-if="form.errors.middle_name"
                                                            id="validationServer03Feedback"
                                                            class="invalid-feedback">
                                                            {{ form.errors.middle_name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <span>{{ __('profile.country') }}:</span>
                                                <p v-if="!editForm">{{ form.country_code?.name || '-' }}</p>
                                                <div v-else class="d-md-inline-flex">
                                                    <div class="p-1">
                                                        <Dropdown
                                                            id="dropdown-size"
                                                            v-model="form.country_code"
                                                            class="form-control"
                                                            :placeholder="__('profile.country_placeholder')"
                                                            label="name"
                                                            value="code"
                                                            :options="countries"
                                                        />
                                                        <div
                                                            v-if="form.errors.country_code"
                                                            id="validationServer03Feedback"
                                                            class="invalid-feedback">
                                                            {{ form.errors.country_code }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <span>{{ __('profile.sex') }}:</span>
                                                <p v-if="!editForm">{{ form.sex?.label || '-' }}</p>
                                                <div v-else class="d-md-inline-flex">
                                                    <div class="p-1">
                                                        <Dropdown
                                                            id="dropdown-size"
                                                            v-model="form.sex"
                                                            class="form-control"
                                                            :placeholder="__('profile.sex_placeholder')"
                                                            :options="sexOptions"
                                                        />
                                                        <div
                                                            v-if="form.errors.sex"
                                                            id="validationServer03Feedback"
                                                            class="invalid-feedback">
                                                            {{ form.errors.sex }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <span>{{ __('profile.email') }}:</span>
                                                <p v-if="!editForm">{{ form.email || '-' }}</p>
                                                <div v-else class="p-1">
                                                    <input

                                                        id="form-email-name" v-model.trim="form.email"
                                                        class="form-control form-control-sm"
                                                        :class="{'is-invalid': form.errors.email}"
                                                        aria-describedby="Provide your email"
                                                        type="text">
                                                    <div
                                                        v-if="form.errors.email"
                                                        id="validationServer03Feedback"
                                                        class="invalid-feedback">
                                                        {{ form.errors.email }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <span>{{ __('profile.birthday') }}:</span>
                                                <p v-if="!editForm">{{ formatDate(form.birthday) || '-' }}</p>
                                                <VueDatePicker
                                                    v-else
                                                    v-model="form.birthday"
                                                    class="datepicker"
                                                    :format="birthdayFormat"
                                                    :locale="birthdayLocale"
                                                    :max-date="maxBirthdayDate"
                                                    :start-date="startBirthdayDate"
                                                    :month-change-on-scroll="false"
                                                    :auto-apply="true"
                                                    input-class-name="form-control"
                                                    placeholder="Виберіть дату народження"
                                                    :enable-time-picker="false"></VueDatePicker>
                                            </li>
                                            <li>
                                                <span>{{ __('profile.phone') }}:</span>
                                                <p v-if="!editForm">{{ form.phone || '-' }}</p>
                                                <div v-else class="p-1">
                                                    <input
                                                        id="form-phone-name"
                                                        v-model="form.phone"
                                                        v-maska
                                                        data-maska="+38 (###) ###-##-##"
                                                        class="form-control form-control-sm"
                                                        :class="{'is-invalid': form.errors.phone}"
                                                        aria-describedby="Provide your phone"
                                                        type="text">
                                                    <div
                                                        v-if="form.errors.phone"
                                                        id="validationServer03Feedback"
                                                        class="invalid-feedback">
                                                        {{ form.errors.phone }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <span>{{ __('profile.zip') }}:</span>
                                                <p v-if="!editForm">{{ form.zip || '-' }}</p>
                                                <div v-else class="p-1">
                                                    <input
                                                        id="form-zip"
                                                        v-model="form.zip"
                                                        class="form-control form-control-sm"
                                                        :class="{'is-invalid': form.errors.zip}"
                                                        aria-describedby="Provide your zip code"
                                                        type="text">
                                                    <div
                                                        v-if="form.errors.zip"
                                                        id="validationServer03Feedback"
                                                        class="invalid-feedback">
                                                        {{ form.errors.zip }}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div v-if="changedAttribute" class="row">
                                            <div class="col-12 text-right">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-sm" :disabled="form.processing"
                                                    @click="save">Зберегти
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
import profile from '@/Mixins/profile.js';
import {useForm, Head} from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import {locales} from '@/enums/localesEnum.js';
import {sexItems} from '@/enums/sexEnum.js';
import DatetimeService from '@/Services/DatetimeService.ts';
import {vMaska} from 'maska';
import {reactive} from 'vue';
import FormService from '@/Services/FormService.ts';
import {UserService} from '@/Services/UserService.ts';

export default {
    name: 'ProfileDetails',
    components: {
        Dropdown,
        VueDatePicker,
        DashboardMenu,
        Head,
    },
    directives: {maska: vMaska},
    mixins: [profile],
    layout: [BaseLayout],
    data: () => ({
        birthdayFormat: 'yyyy-MM-dd',
        editForm: false,
        results: null,
        errors: reactive({avatar: null}),
        uploadedAvatarUrl: null,
        uploadedAvatarName: null,
        form: useForm({
            first_name: null,
            middle_name: null,
            last_name: null,
            country_code: null,
            sex: null,
            zip: null,
            email: null,
            phone: null,
            birthday: null,
            avatar: null,
        }),
        countries: [],
    }),
    computed: {
        avatarURL() {
            if (this.uploadedAvatarUrl) return this.uploadedAvatarUrl;
            if (this.user.avatar) return this.assetStorage(this.user.avatar);

            return this.asset(UserService.defaultAvatarURL);
        },
        sexOptions() {
            let options = [];
            for (let item in sexItems) {
                options.push({
                    label: this.__(`profile.sex.${item.toLowerCase()}`),
                    value: sexItems[item],
                });
            }
            return options;
        },
        startBirthdayDate() {
            const now = new Date();
            return new Date(now.getFullYear() - 16, now.getMonth(), now.getDate());
        },
        maxBirthdayDate() {
            const now = new Date();
            return new Date(now.getFullYear() - 16, now.getMonth(), now.getDate());
        },
        birthdayLocale() {
            return locales[this.$page.props.settings.locale];
        },
        changedAttribute() {
            return this.form.isDirty;
        },
        fullName() {
            let result = '';
            [this.form.last_name, this.form.first_name, this.form.middle_name].forEach((item) => {
                if (item) {
                    result += `${item} `;
                }
            });

            return result.slice(0, -1) || '-';
        },
    },
    created() {
        this.getCountries();
    },
    mounted() {
        this.init();
    },
    methods: {
        openFileInput() {
            this.$refs.fileInput.click();
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.errors.avatar = FormService.validateUploadAvatar(file);
                console.log(this.errors.avatar);
                if (!this.errors.avatar) {
                    this.uploadedAvatarName = file.name;
                    this.uploadedAvatarUrl = URL.createObjectURL(file);
                }
            }
        },
        formatDate(date) {
            return DatetimeService.formatDate(date);
        },
        toggleEditForm() {
            this.editForm = !this.editForm;
        },
        async getCountries() {
            let countries = await this.$request.axios.get(this.route('api.countries'));
            this.countries = countries.data;
        },
        save() {
            console.log(this.form);
            this.form.transform((data) => ({
                ...data,
                _method: 'put',
                country_code: data.country_code?.code,
                sex: data.sex?.value,
            })).post(this.route('profile.profile-details.update'), {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: (data) => {
                    this.notifySuccess(data.props.flash.success);
                    this.editForm = false;
                },
                onError: (errors) => this.notifyError(Object.values(errors).join(',')),
            });
        },
        init() {
            let birthday = DatetimeService.formatDate(this.user.birthday);
            const sexOption = this.sexOptions.find(item => item.value === this.user.sex);
            this.form.defaults({
                first_name: this.user.first_name,
                middle_name: this.user.middle_name,
                last_name: this.user.last_name,
                country_code: this.user.country,
                email: this.user.email,
                zip: this.user.zip,
                sex: sexOption,
                phone: this.user.phone,
                avatar: null,
                birthday: birthday,
            });
            this.form.first_name = this.user.first_name;
            this.form.middle_name = this.user.middle_name;
            this.form.last_name = this.user.last_name;
            this.form.country_code = this.user.country;
            this.form.sex = sexOption;
            this.form.zip = this.user.zip;
            this.form.email = this.user.email;
            this.form.phone = this.user.phone;
            this.form.birthday = birthday;
        },
    },
};
</script>

<style lang="scss" scoped>
@import "@/../sass/_variables.scss";

.user-profile-list {
    li {
        display: flex;
        align-items: center;
    }
}

.dashboard-user-profile {
    position: relative;
}

.form-control {
    max-width: 200px;
    width: 100%;
}

.nice-select {
    width: 240px;
}

.edit-info-btn {
    position: absolute;
    top: 0px;
    right: 10px;
    color: lighten($mutted-color, 30%);
    padding: 0 10px;

    &:hover {
        color: lighten($mutted-color, 0%);
    }
}

</style>
