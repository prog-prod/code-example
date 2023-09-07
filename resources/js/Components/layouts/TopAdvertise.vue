<template>
    <div
        v-if="status" class="alert alert-secondary alert-dismissible fade show rounded-0 border-0 p-0 mb-0"
        :style="bgColor"
        role="alert">
        <div class="d-flex justify-content-center align-items-center">
            <Link :href="link"><img :src="assetStorage(image)" class="alert-image" alt=""></Link>
        </div>
    </div>

</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'TopAdvertise',
    components: {
        Link,
    },
    computed: {
        link() {
            return this.$page.props.settings.layout.top_ads_link;
        },
        status() {
            return this.$page.props.settings.layout.top_ads_status;
        },
        image() {
            return this.$page.props.settings.layout.top_ads_image;
        },
        bgColor() {
            return `background-color: ${this.$page.props.settings.layout.top_ads_bg_color}`;
        },
    },
};
</script>

<style lang="scss" scoped>
.alert-image {
    width: 100%;
}
</style>
