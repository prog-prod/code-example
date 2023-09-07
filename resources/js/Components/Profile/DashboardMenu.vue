<template>
    <ul class="list-inline dashboard-menu text-center">
        <li class="list-inline-item">
            <Link
                :href="route('profile.profile-details.index')"
                :class="{
                    active: route().current() === 'profile.profile-details.index',
                }"
            >{{ __('profile.details') }}
            </Link>
        </li>
        <li class="list-inline-item">
            <Link
                :href="route('profile.order.index')"
                :class="{
                    active: route().current() === 'profile.order.index',
                }"
            > {{ __('profile.orders') }}
            </Link>
        </li>
        <li class="list-inline-item">
            <Link
                :href="route('profile.address.index')"
                :class="{
                    active: route().current() === 'profile.address.index',
                }"
            >{{ __('profile.address') }}
            </Link>
        </li>
    </ul>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: 'DashboardMenu',
    components: {
        Link,
    },
};
</script>

<style lang="scss" scoped>
@import "@/../sass/_variables.scss";

.dashboard-menu {
    @media (max-width: $max_width_cxs) {
        li a {
            font-size: 10px;
        }
    }
    @media (max-width: $max_width_mxs) {
        li {
            margin-right: 1px;

            a {
                padding-left: 5px;
                padding-right: 5px;
            }
        }
    }
}
</style>
