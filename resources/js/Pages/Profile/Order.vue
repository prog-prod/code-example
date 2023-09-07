<template>
    <Head :title="__('profile.meta-title')"/>
    <section class="user-dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <DashboardMenu/>
                    <div class="dashboard-wrapper user-dashboard">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('profile.orders.order_number') }}</th>
                                    <th>{{ __('profile.orders.date') }}</th>
                                    <th>{{ __('profile.orders.items') }}</th>
                                    <th>{{ __('profile.orders.total_price') }}</th>
                                    <th>{{ __('profile.orders.status') }}</th>
                                    <th>{{ __('profile.orders.payment_status') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-for="(order,key) in user.orders" :key="key">
                                    <tr>
                                        <td>{{ order.id }}</td>
                                        <td>{{ order.created_at }}</td>
                                        <td>{{ order.items.length }}</td>
                                        <td>{{ order.total_price.amount }} {{ order.total_price.symbol }}</td>
                                        <td>
                                            <OrderStatus :status="order.status"/>
                                        </td>
                                        <td>
                                            <template v-if="order.payment">
                                                <PaymentStatus :status="order.payment.status"/>
                                                <div class="overpaid-info">
                                                    <small v-html="getOverpaidAmount(order)"></small>
                                                </div>
                                            </template>
                                            <template v-else>
                                                -
                                            </template>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <a
                                                    :href="`#collapse${key}`" data-toggle="collapse"
                                                    role="button" aria-expanded="false"
                                                    :aria-controls="`collapse${key}`"
                                                    class="btn btn-sm btn-outline-primary">{{
                                                        __('profile.orders.show_products')
                                                    }}</a>
                                            </div>
                                            <template v-if="canCancelOrder(order)">
                                                <a
                                                    href="#"
                                                    class="btn-cancel-order"
                                                    @click.prevent="cancelOrder(order)">{{
                                                        __('profile.orders.cancel_order')
                                                    }}</a>
                                            </template>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <div :id="`collapse${key}`" class="collapse">
                                                <table class="w-100">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('profile.orders.products') }}</th>
                                                        <th>{{ __('profile.orders.price') }}</th>
                                                        <th>{{ __('profile.orders.quantity') }}</th>
                                                        <th>{{ __('profile.orders.total_price') }}</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <template v-for="(item, key2) in order.items" :key="key2">
                                                        <tr>
                                                            <td>
                                                                <Link
                                                                    :href="productLink(item.product)">
                                                                    <img
                                                                        width="40"
                                                                        class="product-img img-fluid mr-1"
                                                                        :src="productImage(item.product)"
                                                                        alt="product-img">
                                                                    {{ item.product.name }}
                                                                </Link>
                                                            </td>
                                                            <td>
                                                                {{ calcProductPrice(item) }}
                                                            </td>
                                                            <td> {{ item.quantity }}</td>
                                                            <td> {{ item.price.amount }} {{ item.price.symbol }}</td>
                                                        </tr>
                                                    </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-if="user.orders.length === 0">
                                    <td class="text-center" colspan="6"> {{ __('profile.orders.no_orders') }}</td>
                                </tr>
                                </tbody>
                            </table>
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
import OrderStatus from '@/Components/Profile/OrderStatus.vue';
import {Link, Head} from '@inertiajs/vue3';
import {ProductService} from '@/Services/ProductService.ts';
import PaymentStatus from '@/Components/Profile/PaymentStatus.vue';
import {PaymentStatuses} from '@/enums/PaymentStatuses.js';
import {OrderService} from '@/Services/OrderService.ts';

export default {
    name: 'Order',
    components: {
        PaymentStatus,
        DashboardMenu,
        OrderStatus,
        Link,
        Head,
    },
    layout: [BaseLayout],
    computed: {
        productService() {
            return new ProductService(this.product);
        },
        PaymentStatuses() {
            return PaymentStatuses;
        },
    },
    mounted() {
        console.log(this.user.orders);
    },
    methods: {
        canCancelOrder(order) {
            return OrderService.canUserCancelOrder(order);
        },
        getOverpaidAmount(order) {
            let overpaid = order.payment?.overpaid;
            if (overpaid) {
                // if (Number(overpaid.amount) > 0) {
                //     let totalPaidAmount = order.total_price.amount + overpaid.amount;
                //     let overpaidAmount = Math.abs(overpaid.amount);
                //     return `${this.__('profile.orders.paid')}: ${totalPaidAmount} ${overpaid.symbol}<br>
                //             ${this.__('profile.orders.overpaid')}: ${overpaidAmount} ${overpaid.symbol}`;
                // }
                if (Number(overpaid.amount) < 0) {
                    let totalPaidAmount = order.total_price.amount + overpaid.amount;
                    let payExtraAmount = Math.abs(overpaid.amount);
                    return `${this.__('profile.orders.paid')}: ${totalPaidAmount} ${overpaid.symbol}<br>
                            ${this.__('profile.orders.pay_extra')}: ${payExtraAmount} ${overpaid.symbol}`;
                }
            }
            return '';
        },
        cancelOrder(order) {
            if (window.confirm(this.__('profile.orders.are_you_sure_cancel_order'))) {
                this.$request.send('post', this.route('profile.order.cancel-order', order.id), {}, {
                    preserveScroll: true,
                });
            }
        },
        productImage(product) {
            return product.main_image ? this.assetStorage(product.main_image.filename) : this.assetStorage(this.defaultProductImg);
        },
        calcProductPrice(item) {
            return item.price.amount / item.quantity;
        },
        productLink(product) {
            return this.productService.getProductLink(product);
        },
    },
};
</script>

<style scoped>
.btn-cancel-order {
    font-size: 10px;
}

.overpaid-info {
    line-height: 16px;
}
</style>
