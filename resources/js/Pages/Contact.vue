<template>
    <Head :title="__('contact.meta-title')"/>
    <div>
        <!-- google map -->
        <section class="map">
            <!-- Google Map -->
            <iframe
                width="100%"
                height="500"
                style="border:0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                :src="mapSrc">
            </iframe>
        </section>
        <!-- /google map -->

        <!-- contact -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- form -->
                    <div class="col-lg-7 mb-5 mb-lg-0 text-center text-md-left">
                        <h2 class="section-title">{{ __('contact.title') }}</h2>
                        <form class="row" @submit.prevent>
                            <div class="col-md-6">
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    name="name"
                                    :placeholder="__('contact.form.name')"
                                    class="mb-4"
                                    :rounded="false"
                                />
                            </div>
                            <div class="col-md-6">
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    :placeholder="__('contact.form.email')"
                                    class="mb-4"
                                    :rounded="false"
                                />
                            </div>
                            <div class="col-md-12">
                                <TextareaComponent
                                    id="message"
                                    v-model="form.message"
                                    class="mb-4"
                                    :placeholder="__('contact.form.message')"
                                    name="message"
                                    :rounded="false"/>
                            </div>
                            <div class="col-md-12">
                                <button type="button" value="send" class="btn btn-primary" @click="sendForm">
                                    {{ __('contact.btn.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- contact item -->
                    <div class="col-lg-4">
                        <div class="d-flex mb-60">
                            <i class="ti-location-pin contact-icon"></i>
                            <div>
                                <h4>{{ __('contact.our_location') }}</h4>
                                <p class="text-gray">{{ settings.layout.address }}</p>
                            </div>
                        </div>
                        <div class="d-flex mb-60">
                            <i class="ti-mobile contact-icon"></i>
                            <div>
                                <h4>{{ __('contact.call_us_now') }}</h4>
                                <template v-for="(phone, key) in phones" :key="key">
                                    <p class="text-gray mb-0">{{ phone }}</p>
                                </template>
                            </div>
                        </div>
                        <div class="d-flex mb-60">
                            <i class="ti-email contact-icon"></i>
                            <div>
                                <h4>{{ __('contact.write_us_now') }}</h4>
                                <template v-for="(email, key) in emails" :key="key">
                                    <p class="text-gray mb-0">{{ email }}</p>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /contact -->
    </div>
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaComponent from '@/Components/TextareaComponent.vue';
import {useForm, Head} from '@inertiajs/vue3';

export default {
    name: 'Contact',
    components: {TextareaComponent, TextInput, Head},
    layout: [BaseLayout],
    data: () => ({
        googleApiKey: 'AIzaSyA338nLqlSO2dCAzd2F-vF8tkSpHaSjF88',
        form: useForm({
            message: null,
            email: null,
            name: null,
            subject: 'Contact page',
        }),
    }),
    computed: {
        phones() {
            return this.settings.layout.phones.split(',');
        },
        emails() {
            return this.settings.layout.emails.split(',');
        },
        mapSrc() {
            return `https://www.google.com/maps/embed/v1/place?key=${this.googleApiKey}&q=проспект+Володимирський,+Лубны,+Полтавская+область,+37501/`;
        },
    },
    mounted() {
        this.form.name = this.user?.name;
        this.form.email = this.user?.email;
    },
    methods: {
        sendForm() {
            this.form.clearErrors();
            this.form.post(this.route('contact.send-message'), {
                preserveScroll: true,
                onFinish: () => this.form.reset(),
                onError: (error) => this.notifyError(Object.values(error).join(',')),
            });
        },
    },
};
</script>

<style scoped>

</style>
