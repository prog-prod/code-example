<template>
    <div v-if="method" class="delivery-container">
        <template v-if="method.key === DeliveryMethods.NOVAPOSHTA_DEPARTMENT">
            <DeliveryFormNovaPoshtaDepartment/>
        </template>
        <template v-else-if="method.key === DeliveryMethods.NOVAPOSHTA_COURIER">
            <div v-if="showSavedAddressesInput" class="saved-addresses-group-input">
                <label for="address">{{ __('checkout.form.labels.saved_addresses') }}</label>
                <DropdownSelect v-model="userAddress" :options="addressesOptions"/>
            </div>
            <DeliveryFormNovaPoshtaCourier/>
        </template>
    </div>
</template>

<script>
import {DeliveryMethods} from '@/Services/Enumns/DeliveryMethods.ts';
import {mapActions, mapGetters} from 'vuex';
import DeliveryFormNovaPoshtaCourier from '@/Components/Payment/Checkout/DeliveryFormNovaPoshtaCourier.vue';
import DeliveryFormNovaPoshtaDepartment from '@/Components/Payment/Checkout/DeliveryFormNovaPoshtaDepartment.vue';
import DropdownSelect from '@/Components/UI/DropdownSelect.vue';
import checkout from '@/Mixins/checkout.js';

export default {
    name: 'DeliveryForm',
    components: {DropdownSelect, DeliveryFormNovaPoshtaDepartment, DeliveryFormNovaPoshtaCourier},
    mixins: [checkout],
    props: {
        method: {
            required: true,
            type: Object,
        },
    },
    data: () => ({
        addressesOptions: [],
        userAddress: null,
    }),
    computed: {
        defaultAddress() {
            return this.userService.getDefaultAddress();
        },
        userAddresses() {
            return this.userService.getAddressOptions();
        },
        showSavedAddressesInput() {
            return this.user && this.addressesOptions.length > 0;
        },
        DeliveryMethods() {
            return DeliveryMethods;
        },
        ...mapGetters({
            form: 'checkout/form',
        }),
    },
    watch: {
        userAddress(newValue) {
            let address = this.userAddresses.find(address => address.id === newValue.value);
            if (address) {
                this.updateFormElements({
                    city: JSON.parse(JSON.stringify(address.city)),
                    street: JSON.parse(JSON.stringify(address.street)),
                    house: address.house,
                    flat: address.flat,
                });
            }
        },
    },
    mounted() {
        this.initAddressInput();
    },
    methods: {
        ...mapActions({
            updateFormElements: 'checkout/updateFormElements',
        }),
        fetchNovaPoshtaDepartments(search, loading) {
            this.formService.debouncedFetchCities(search, loading).then(data => this.novaPoshtaDepartments = data);
        },
        initAddressInput() {
            this.addressesOptions = this.userAddresses.map((address) => ({
                label: address.full_address,
                value: address.id,
            }));

            this.userAddress = {
                label: this.defaultAddress?.full_address,
                value: this.defaultAddress?.id,
            };
        },
    },

};
</script>

<style scoped>
.saved-addresses-group-input {
    margin-bottom: 30px;
    border-bottom: 1px dashed #cccccc;
    padding-bottom: 30px;
}
</style>
