<template>
    <Head :title="title"/>
    <section class="page-404 section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a :href="route('index')">
                        <h2>PRINTOPIA</h2>
                    </a>
                    <h1 v-if="status === code_not_found">404</h1>
                    <h1 v-else>{{ status }}</h1>
                    <h2 v-if="status === code_unavailable">{{ __('main.service_unavailable') }}</h2>
                    <h2 v-else>{{ __('main.not_found') }}</h2>
                    <a v-if="status !== code_unavailable" :href="route('index')" class="btn btn-primary mt-4"><i
                        class="ti-angle-double-left"></i>
                        {{ __('main.go_home') }}</a>
                    <p class="copyright-text">{{ __('main.footer.all_rights_reserved', {'year': year}) }}</p>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import {Head} from '@inertiajs/vue3';

export default {
    name: 'Error',
    components: {
        Head,
    },
    layout: [BaseLayout],
    props: {
        status: Number,
    },
    data: () => ({
        code_unavailable: 503,
        code_not_found: 404,
        year: new Date().getFullYear(),
    }),
    computed: {
        title() {
            return {
                503: `503: ${this.__('main.service_unavailable')}`,
                500: '500: Server Error',
                404: `404: ${this.__('main.not_found')}`,
                403: '403: Forbidden',
            }[this.status];
        },
        description() {
            return {
                503: 'Sorry, we are doing some maintenance. Please check back soon.',
                500: 'Whoops, something went wrong on our servers.',
                404: 'Sorry, the page you are looking for could not be found.',
                403: 'Sorry, you are forbidden from accessing this page.',
            }[this.status];
        },
    },
};
</script>

<style scoped>

</style>
