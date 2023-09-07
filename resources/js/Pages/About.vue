<template>
    <div>
        <Head :title="meta.title">
            <meta name="keywords" :content="meta.keywords"/>
            <meta name="description" :content="meta.description"/>
        </Head>
        <!-- about -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- image circle background -->
                        <div class="about-img-bg"></div>
                        <img class="product-img img-fluid mb-4 mb-md-0" src="/images/logo.png" alt="product-img">
                    </div>
                    <div class="col-md-6">
                        <h2 class="section-title">{{ __('about.title') }}</h2>
                        <p class="mb-4">{{ __('about.text.p1') }}</p>
                        <p class="mb-4">{{ __('about.text.p2') }}</p>

                        <ul class="pl-0">
                            <li class="d-flex">
                                <i class="ti-check mr-3 mt-1"></i>
                                <div>
                                    <h4>{{ __('about.benefits.0.title') }}</h4>
                                    <p>{{ __('about.benefits.0.desc') }}</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <i class="ti-check mr-3 mt-1"></i>
                                <div>
                                    <h4>{{ __('about.benefits.1.title') }}</h4>
                                    <p>{{ __('about.benefits.1.desc') }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- /about -->


        <section
            class="section overlay cta" data-background="/images/cta.jpg"
            style="background-image: url('/images/cta.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="text-white mb-2">{{ __('about.action_section.title') }}</h1>
                        <p class="text-white mb-4">{{ __('about.action_section.desc') }}</p>
                        <Link :href="route('products.index')" class="btn btn-light">
                            {{ __('about.action_section.btn') }}
                        </Link>
                    </div>
                </div>
            </div>
        </section>
        <SectionNewsletter/>
    </div>
</template>

<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import SectionNewsletter from '@/Components/Main/SectionNewsletter.vue';
import {Head, Link} from '@inertiajs/vue3';

export default {
    name: 'About',
    components: {
        SectionNewsletter,
        Head,
        Link,
    },
    layout: [BaseLayout],
    props: {
        page: Object,
    },
    computed: {
        meta() {
            return {
                title: this.page.meta_title,
                keywords: this.page.meta_keywords,
                description: this.page.meta_description,
            };
        },
    },
};
</script>

<style scoped>
.product-img {
    margin: 90px auto;
}
</style>
