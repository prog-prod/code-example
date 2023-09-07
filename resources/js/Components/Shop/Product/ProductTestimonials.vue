<template>
    <Modal v-model="showAllTestimonials">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center mb-4 mt-4">{{
                            __('product.testimonial.modal.reviews.title', {item: product.name})
                        }}</h3>
                </div>
                <template v-for="(testimonial, key) in product.reviews" :key="key">
                    <div class="col-lg-12 mb-3 mt-3 px-md-5">
                        <TestimonialComponent v-bind="{testimonial}"/>
                        <hr v-if="key < product.reviews.length - 1" class="mb-0">
                        <div v-else class="mb-5"></div>
                    </div>
                </template>
            </div>
        </div>
    </Modal>
    <section id="product-testimonials" class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-5">{{ __('product.testimonial.title') }}</h3>
                </div>
                <template v-for="(testimonial, key) in testimonials" :key="key">
                    <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                        <TestimonialComponent v-bind="{testimonial}"/>
                    </div>
                </template>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <template v-if="product.reviews.length > maxTestimonials">
                        <a class="btn btn-primary btn-sm" href="" @click.prevent="showMore">
                            {{ __('product.details.button.see_more') }}...</a>
                    </template>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import TestimonialComponent from '@/Components/Shop/Product/TestimonialComponent.vue';
import Modal from '@/Components/UI/Modal.vue';

export default {
    name: 'ProductTestimonials',
    components: {
        TestimonialComponent,
        Modal,
    },
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    data: () => ({
        maxTestimonials: 3,
        showAllTestimonials: false,
    }),
    computed: {
        testimonials() {
            return this.product.reviews.slice(0, this.maxTestimonials);
        },
    },
    methods: {
        showMore() {
            this.showAllTestimonials = true;
        },
    },

};
</script>

<style scoped>
.see_more {
}
</style>
