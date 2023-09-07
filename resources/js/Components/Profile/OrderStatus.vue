<template>
    <template v-if="orderStatus === OrderStatuses.CANCELED">
        <span class="badge badge-danger">{{ __('order.status.CANCELED') }}</span>
    </template>
    <template v-else-if="orderStatus === OrderStatuses.PENDING">
        <span class="badge badge-warning">{{ __('order.status.PENDING') }}</span>
    </template>
    <template v-else-if="orderStatus === OrderStatuses.PENDING_PAYMENT">
        <span class="badge badge-warning">{{ __('order.status.PENDING_PAYMENT') }}</span>
    </template>
    <template v-else-if="orderStatus === OrderStatuses.PROCESSING">
        <span class="badge badge-light">{{ __('order.status.PROCESSING') }}</span>
    </template>
    <template v-else-if="orderStatus === OrderStatuses.SHIPPED">
        <span class="badge badge-primary">{{ __('order.status.SHIPPED') }}</span>
    </template>
    <template v-else-if="orderStatus === OrderStatuses.DELIVERED">
        <span class="badge badge-success">{{ __('order.status.DELIVERED') }}</span>
    </template>
    <template v-else-if="orderStatus === OrderStatuses.DONE">
        <span class="badge badge-success">{{ __('order.status.DONE') }}</span>
    </template>
</template>

<script>
import {OrderStatuses} from '@/enums/OrderStatusesEnum.js';

export default {
    name: 'OrderStatus',
    props: {
        status: {
            type: String,
            require: true,
        },
    },
    computed: {
        OrderStatuses() {
            return OrderStatuses;
        },
        orderStatus() {
            return Number(this.status);
        },
    },
};
</script>

<style scoped>

</style>
