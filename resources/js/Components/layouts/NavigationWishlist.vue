<template>
    <div class="header-actions">
        <Link :href="route('wishlist.index')" class="header-actions__btn">
            <i class="ti-heart"></i>
            <span
                v-if="$page.props.settings.countItemsWishlist > 0"
                class="header-actions__btn__badge">{{ $page.props.settings.countItemsWishlist || '' }}</span>
        </Link>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'NavigationWishlist',
    components: {
        Link,
    },
};
</script>

<style lang="scss" scoped>

</style>
