<template>
    <div class="header-actions">
        <Link :href="route('comparisons.index')" class="header-actions__btn">
            <ScaleIcon :width="21" :height="21"/>
            <span
                v-if="$page.props.settings.countItemsComparisons > 0"
                class="header-actions__btn__badge">{{ $page.props.settings.countItemsComparisons || '' }}</span>
        </Link>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';
import ScaleIcon from '@/Components/Icons/ScaleIcon.vue';

export default {
    name: 'NavigationComparison',
    components: {
        Link,
        ScaleIcon,
    },
};
</script>

<style lang="scss" scoped>

</style>
