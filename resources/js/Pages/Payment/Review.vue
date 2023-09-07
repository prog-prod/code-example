<template>
    <Head :title="__('checkout.title')"/>

    <!-- ORDER-REVIEW -->
    <section class="section">
        <div class="container sticky-container">
            <div class="row">
                <div class="col-md-8">
                    <div class="inner-wrapper border-box">
                        <PaymentNavigation/>

                        <!-- review -->
                        <h3>Order Review</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td></td>
                                    <td>Product Name</td>
                                    <td>Quantity</td>
                                    <td>Sub Total</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="align-middle"><img
                                        class="img-fluid"
                                        src="{{asset('/images/product-1.jpg')}}"
                                        alt="product-img"></td>
                                    <td class="align-middle">Tops</td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">$220.00</td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><img
                                        class="img-fluid"
                                        src="{{asset('/images/product-2.jpg')}}"
                                        alt="product-img"></td>
                                    <td class="align-middle">Jacket</td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">$520.00</td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><img
                                        class="img-fluid"
                                        src="{{asset('/images/product-1.jpg')}}"
                                        alt="product-img"></td>
                                    <td class="align-middle">Tops</td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">$220.00</td>
                                </tr>
                                <tr>
                                    <td class="align-middle"><img
                                        class="img-fluid"
                                        src="{{asset('/images/product-2.jpg')}}"
                                        alt="product-img"></td>
                                    <td class="align-middle">Jacket</td>
                                    <td class="align-middle">1</td>
                                    <td class="align-middle">$520.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /review -->

                        <!-- shipping-information -->
                        <h3 class="mb-5 border-bottom pb-2">Shipping Information</h3>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <h4 class="mb-3">Shipping Address</h4>
                                <ul class="list-unstyled">
                                    <li>Somrat</li>
                                    <li>Mohammadpur, Dhaka 120, Bangladesh</li>
                                    <li>248-321-5879</li>
                                    <li>example.site@email.com</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4 class="mb-3">Shipping Method</h4>
                                <ul class="list-unstyled">
                                    <li>Standard Ground (USPS) - $9.50</li>
                                    <li>Delivered in 8-10 business days.</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4 class="mb-3">Payment Method</h4>
                                <ul class="list-unstyled">
                                    <li>Credit Card:</li>
                                    <li>**** **** **** 2637</li>
                                </ul>
                            </div>
                        </div>

                        <!-- buttons -->
                        <div class="p-4 bg-gray d-flex justify-content-between">
                            <Link :href="route('checkout.payment.index')" class="btn btn-dark">Back</Link>
                            <Link :href="route('checkout.confirm.index')" class="btn btn-primary">Continue</Link>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <OrderSummary/>
                </div>
            </div>
        </div>
    </section>
    <!-- /ORDER-REVIEW -->
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import PaymentNavigation from '@/Components/Payment/PaymentNavigation.vue';
import OrderSummary from '@/Components/Payment/OrderSummary.vue';
import {Link, Head} from '@inertiajs/vue3';

export default {
    name: 'Review',
    components: {
        Link,
        Head,
        OrderSummary,
        PaymentNavigation,
    },

    layout: [BaseLayout],
};
</script>

<style scoped>

</style>
