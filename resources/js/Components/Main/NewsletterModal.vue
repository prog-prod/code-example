<template>
    <Modal v-model="showModal">
        <div class="col-lg-6 px-0">
            <!-- newsletter image -->
            <div class="image"><img
                :src="asset('images/newsletter-popup.jpg')" alt="products"
                class="img-fluid w-100 rounded-left"></div>
        </div>
        <div class="col-lg-6 align-self-center p-5">
            <!-- Content start -->
            <div class="text-center align-self-center">
                <h3 class="mb-lg-5 mb-4">{{ __('newsletter.modal.title') }}</h3>
                <h4>{{ __('newsletter.modal.want_instant') }}</h4>
                <h2 class="mb-lg-5 mb-4">{{ __('newsletter.modal.off', {percent: 10}) }}</h2>
                <!-- newsletter form -->
                <div class="form">
                    <input
                        id="email" type="email" class="form-control mb-3" name="email"
                        :placeholder="__('newsletter.modal.email')">
                    <button class="btn btn-primary w-100" type="submit">{{ __('newsletter.modal.btn') }}</button>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script>
import Modal from '@/Components/UI/Modal.vue';

export default {
    name: 'NewsletterModal',
    components: {
        Modal,
    },
    data: () => ({
        showModal: false,
    }),
    mounted() {
        // setTimeout(() => this.showModal = true, 2000);
    },
};
</script>

<style scoped>

</style>
