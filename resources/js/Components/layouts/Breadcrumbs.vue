<template>
    <nav class="bg-gray py-1">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <template v-for="(breadcrumb,key) in breadcrumbs">
                    <li class="breadcrumb-item" :class="{'active' : (key === breadcrumbs.length - 1)}">
                        <Link :href="breadcrumb.to">
                            <template v-if="breadcrumb.icon">
                                <i class="ti" :class="breadcrumb.icon"></i>
                            </template>
                            <template v-else-if="breadcrumb.label">
                                {{ breadcrumb.label }}
                            </template>
                        </Link>
                    </li>
                </template>
            </ol>
        </div>
    </nav>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'Breadcrumbs',
    components: {
        Link,
    },
    props: {
        breadcrumbs: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style lang="scss" scoped>
@import "@/../sass/_variables.scss";

.breadcrumb-item {
    a {
        font-size: 14px;
        @media (max-width: $max_width_xs) {
            font-size: 12px;
        }
        @media (max-width: $max_width_cxs) {
            font-size: 10px;
        }
    }
}
</style>
