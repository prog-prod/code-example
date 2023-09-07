<template>
    <section class="section overlay cta" :style="`background-image: url(${assetStorage(image)})`">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="text-white mb-2">{{ title }}</h1>
                    <p class="text-white mb-4">{{ text }}</p>
                    <Link :href="route('products.index')" class="btn btn-light">{{ __('main.sale_btn') }}</Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'SectionSale',
    components: {
        Link,
    },
    props: {
        title: String,
        text: String,
        bgImage: String,
    },
    computed: {
        image() {
            return this.bgImage;
        },
    },
};
</script>

<style scoped>

</style>
