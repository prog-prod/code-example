<template>
    <template v-if="paymentStatus === PaymentStatuses.CANCELED">
        <span class="badge badge-danger">{{ __('payment.status.CANCELED') }}</span>
    </template>
    <template v-if="paymentStatus === PaymentStatuses.FAILED">
        <span class="badge badge-danger">{{ __('payment.status.FAILED') }}</span>
    </template>
    <template v-else-if="paymentStatus === PaymentStatuses.PENDING">
        <span class="badge badge-warning">{{ __('payment.status.PENDING') }}</span>
    </template>
    <template v-else-if="paymentStatus === PaymentStatuses.PARTIALLY_PAID">
        <span class="badge badge-warning">{{ __('payment.status.PARTIALLY_PAID') }}</span>
    </template>
    <template v-else-if="paymentStatus === PaymentStatuses.OVERPAID">
        <span class="badge badge-warning">{{ __('payment.status.OVERPAID') }}</span>
    </template>
    <template v-else-if="paymentStatus === PaymentStatuses.SUCCESS">
        <span class="badge badge-success">{{ __('payment.status.SUCCESS') }}</span>
    </template>
</template>
<script>

import {PaymentStatuses} from '@/enums/PaymentStatuses.js';

export default {
    props: {
        status: {
            type: Number,
            require: true,
        },
    },
    computed: {
        PaymentStatuses() {
            return PaymentStatuses;
        },
        paymentStatus() {
            return Number(this.status);
        },
    },

};
</script>
<style scoped>

</style>
