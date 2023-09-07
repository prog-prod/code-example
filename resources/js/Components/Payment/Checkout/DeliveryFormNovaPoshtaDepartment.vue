<template>
    <form
        @submit.prevent
    >
        <div class="form-group">
            <label for="addressCity">{{ __('profile.address.form.labels.city') }}*</label>
            <DropdownSearch
                v-model="form.deliveryDepartmentCity"
                :options="novaPoshtaCities"
                label="description"
                :error="form.errors.deliveryDepartmentCity"
                :placeholder="__('checkout.form.placeholders.city')"
                required
                @change="validate('deliveryDepartmentCity')"
                @search="fetchNovaPoshtaDepartmentsCities"/>
        </div>

        <div v-if="form.deliveryDepartmentCity" class="form-group">
            <label for="addressCity">{{ __('checkout.form.labels.nova_poshta_department') }}*</label>
            <DropdownSelect
                v-model="form.deliveryDepartment"
                :options="novaPoshtaDepartments"
                :error="form.errors.deliveryDepartment"
                label="description"
                :placeholder="__('checkout.form.placeholders.nova_poshta_department')"
                required
                @change="validate('deliveryDepartment')"
                @search="fetchNovaPoshtaDepartments"
                @search:focus="fetchNovaPoshtaDepartments">
            </DropdownSelect>
        </div>
    </form>
</template>
<script>
import DropdownSearch from '@/Components/UI/DropdownSearch.vue';
import FormService from '@/Services/FormService.ts';
import {mapGetters} from 'vuex';
import DropdownSelect from '@/Components/UI/DropdownSelect.vue';

export default {
    name: 'DeliveryFormNovaPoshtaDepartment',
    components: {DropdownSelect, DropdownSearch},
    data: () => ({
        novaPoshtaCities: [],
        novaPoshtaDepartments: [],
    }),
    computed: {
        formService() {
            return new FormService(this);
        },
        ...mapGetters({
            form: 'checkout/form',
            formRules: 'checkout/formRules',
        }),
    },
    watch: {
        'form.deliveryDepartmentCity'(val) {
            if (!val) {
                this.form.deliveryDepartment = null;
                this.novaPoshtaDepartments = [];
            } else {
                this.fetchNovaPoshtaDepartments();
            }
        },
    },
    methods: {
        validate(field) {
            FormService.validateShippingFormField(this.form, this.formRules, field);
        },
        filterTextForDepartmentsSearching(search) {
            if (!search) return search;

            const regex = /\d+/g;
            const matches = search.match(regex);

            if (matches && matches.length > 0) {
                search = matches.join('');
            } else {
                search = '';
            }
            return search;
        },
        fetchNovaPoshtaDepartmentsCities(search, loading) {
            loading(true);
            this.formService.debouncedFetchNovaPoshtaCities(search, loading)?.then(data => {
                this.novaPoshtaCities = data;
            });
        },
        fetchNovaPoshtaDepartments(search = null, loading = null) {
            if (loading) {
                loading(true);
            }
            search = this.filterTextForDepartmentsSearching(search);
            this.formService.fetchNovaPoshtaDepartments(search, loading, this.form.deliveryDepartmentCity)?.then(data => {
                this.novaPoshtaDepartments = data;
            });
        },
    },
};
</script>

<style scoped>

</style>
