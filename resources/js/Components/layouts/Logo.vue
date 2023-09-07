<template>
    <Link class="navbar-brand order-2 order-lg-1" :href="route('index')">
        <img class="img-fluid" width="135" :src="assetStorage(logo)" alt="logo">
    </Link>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'Logo',
    components: {
        Link,
    },
    props: {
        place: {
            default: 'header',
            type: String,
            validator: function(value) {
                return ['header', 'footer'].includes(value);
            },
        },
    },
    computed: {
        logo() {
            return this.$page.props.settings.layout[`${this.place}_logo`];
        },
    },
};
</script>

<style scoped>

</style>
