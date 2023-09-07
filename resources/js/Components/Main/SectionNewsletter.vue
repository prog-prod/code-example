<template>
    <section class="section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">{{ __('main.newsletter_title') }}</h2>
                    <p class="mb-4">{{ __('main.newsletter_subtitle') }}</p>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-9 col-10 mx-auto">
                    <form action="#" class="d-flex flex-column flex-sm-row" @submit.prevent="subscribe">
                        <input
                            id="mail" v-model="form.email"
                            type="email" class="form-control rounded-0 border-0 mr-3 mb-4 mb-sm-0"
                            :placeholder="__('main.enter_email')">
                        <button type="submit" value="send" class="btn btn-primary">{{ __('main.subscribe') }}</button>
                    </form>
                    <InputError class="text-danger mt-2" :message="form.errors.email"/>

                </div>
            </div>
        </div>
        <!-- Newsletter Modal -->
        <NewsletterModal/>
        <!-- /Newsletter Modal -->
    </section>
</template>

<script>
import NewsletterModal from '@/Components/Main/NewsletterModal.vue';
import {useForm} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

export default {
    name: 'SectionNewsletter',
    components: {
        NewsletterModal,
        InputError,
    },
    data: () => ({
        form: useForm({
            email: '',
        }),
    }),
    methods: {
        subscribe() {
            this.form.clearErrors();
            this.form.post(route('subscribers.store'), {
                preserveScroll: true,
                onFinish: () => {
                    this.form.reset('email');
                },
                onError: (error) => {
                    const text = Object.values(error).join(',');
                    this.notifyError(text);
                },
            });
        },
    },
};
</script>

<style scoped>

</style>
