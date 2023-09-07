<template>
    <form
        @submit.prevent
    >
        <div class="form-group">
            <label for="addressCity">{{ __('profile.address.form.labels.city') }}*</label>
            <DropdownSearch
                v-model="form.city"
                :error="form.errors.city"
                :options="cityOptions"
                label="present"
                :placeholder="__('profile.address.form.placeholder.city')"
                @change="validate('city')"
                @search="fetchCities"/>
        </div>
        <div class="form-group">
            <label for="addressStreet">{{ __('profile.address.form.labels.street') }}*</label>
            <DropdownSearch
                v-model="form.street"
                :error="form.errors.street"
                :options="streetOptions"
                label="present"
                :disabled="streetDisabled"
                :placeholder="__('profile.address.form.placeholder.street')"
                @change="validate('street')"
                @search="fetchStreets"/>
        </div>
        <div class="form-group">
            <label for="reviewText">{{ __('profile.address.form.labels.house') }}*</label>
            <TextInput
                id="house"
                v-model="form.house"
                :error="form.errors.house"
                :placeholder="__('profile.address.form.placeholder.house')"
                type="text"
                :disabled="houseDisabled"
                class="form-control"
                required
                autofocus
                @keyup="validate('house')"
            />
        </div>
        <div class="form-group">
            <label for="reviewText">{{ __('profile.address.form.labels.flat') }}</label>
            <TextInput
                id="flat"
                v-model="form.flat"
                :error="form.errors.flat"
                :placeholder="__('profile.address.form.placeholder.flat')"
                type="text"
                class="form-control"
                :disabled="flatDisabled"
            />
        </div>
    </form>
</template>
<script>
import TextInput from '@/Components/TextInput.vue';
import DropdownSearch from '@/Components/UI/DropdownSearch.vue';
import FormService from '@/Services/FormService.ts';
import {mapActions, mapGetters} from 'vuex';
import DropdownSelect from '@/Components/UI/DropdownSelect.vue';

export default {
    name: 'DeliveryFormNovaPoshtaCourier',
    components: {DropdownSelect, DropdownSearch, TextInput},
    data: () => ({
        novaPoshtaDepartments: [],
        cityOptions: [],
        streetOptions: [],
    }),
    computed: {
        formService() {
            return new FormService();
        },
        streetDisabled() {
            return !this.form.city;
        },
        houseDisabled() {
            return !this.form.city || !this.form.street;
        },
        flatDisabled() {
            return !this.form.city || !this.form.street || !this.form.house;
        },
        ...mapGetters({
            form: 'checkout/form',
            formRules: 'checkout/formRules',
        }),
    },
    watch: {
        'form.city'(val) {
            if (!val) {
                this.resetDeliveryAddressForCourier();
            }
        },
        'form.street'(val) {
            if (!val) {
                this.updateFormElements({
                    house: null,
                    flat: null,
                });
            }
        },
        'form.house'(val) {
            if (!val) {
                this.updateFormElements({
                    flat: null,
                });
            }
        },
    },
    methods: {
        ...mapActions({
            resetDeliveryAddressForCourier: 'checkout/resetDeliveryAddressForCourier',
            updateFormElements: 'checkout/updateFormElements',
        }),
        validate(field) {
            FormService.validateShippingFormField(this.form, this.formRules, field);
        },
        fetchStreets(search, loading) {
            loading(true);
            this.formService.fetchStreets(search, loading, this.form.city.ref)?.then((data) => {
                this.streetOptions = data;
            });
        },
        fetchCities(search, loading) {
            loading(true);
            this.formService.debouncedFetchCities(search, loading)?.then((data) => {
                this.cityOptions = data;
            });
        },
    },
};
</script>

<style scoped>

</style>
