<template>
    <header>
        <div class="site-status">
            <b>{{ __('site.status.development') }}.</b>
        </div>
        <!-- top advertise -->
        <TopAdvertise/>
        <!-- top header -->
        <div class="top-header">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <p class="top-header__text text-white mb-lg-0 mb-1">
                        {{ topHeaderText }}
                    </p>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <ul class="list-inline">
                        <li
                            v-if="!$page.props.auth.user"
                            class="list-inline-item"
                        >
                            <Link :href="route('login', {from})">
                                <i class="ti ti-user mr-1"></i>
                                {{ __('main.sign_in') }}
                            </Link>
                        </li>
                        <template v-if="user">
                            <li class="list-inline-item text-white">
                                <Link :href="route('profile.index')">
                                    <img class="rounded" :src="assetStorage(user.avatar)" width="20" alt="">
                                    <span class="ml-1">
                                        {{ __('main.my_cabinet') }}
                                    </span>
                                </Link>
                            </li>
                            <li class="list-inline-item">
                                <Link :href="route('logout',{from})" method="post">{{
                                        __('main.logout')
                                    }}
                                </Link>
                            </li>
                        </template>
                        <li class="list-inline-item lang-block">
                            <CountryDropdown
                                v-model="locale"
                                :options="locales"
                                @change="changeLocale"
                            />
                        </li>
                        <li class="list-inline-item">
                            <Dropdown
                                v-model="currency"
                                class="country"
                                :options="currencies"
                                :text-overflow="false"
                                label="code"
                                value="name"
                                @change="changeCurrency"
                            />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /top-header -->
    </header>
</template>

<script>
import TopAdvertise from '@/Components/layouts/TopAdvertise.vue';
import {Link} from '@inertiajs/vue3';
import 'vue-select/dist/vue-select.css';
import CountryDropdown from '@/Components/CountryDropdown.vue';
import Dropdown from '@/Components/Dropdown.vue';

export default {
    name: 'Header',
    components: {
        TopAdvertise,
        Link,
        Dropdown,
        CountryDropdown,
    },
    data: () => ({
        locales: null,
        locale: null,
        currencies: null,
        selectedLocale: null,
        currency: '',
        from: route(route().current(), route().params),
    }),
    computed: {
        topHeaderText() {
            return this.$page.props.settings.layout.top_header_text;
        },
    },
    created() {
        this.locales = this.$page.props.settings.locales;
        this.locale = this.$page.props.settings.locale;
        this.currencies = Object.values(this.$page.props.settings.currencies);

        this.currency = this.currencies.find(currency => currency.name === this.$page.props.settings.currency);
    },
    mounted() {
        console.log('settings', this.$page.props.settings);
        console.log('user', this.user);
    },
    methods: {
        async changeLocale(locale) {
            const url = window.location.href.replace(window.location.origin, '');

            // replace the locale prefix with the new one
            let newUrl = url;
            this.locales.forEach(loc => {
                if (url.includes(loc)) {
                    newUrl = url.replace(loc, locale);
                }
            });

            // reload the page with the new URL
            window.location.href = newUrl;
        },
        async changeCurrency(currency) {
            this.$request.send('post', route('switch-currency', {currency: currency.name}), null);
        },
    },
};
</script>

<style lang="scss" scoped>
@import "@/../sass/_variables.scss";

.lang-block {
    position: relative;
}

.top-header__text {
    @media (max-width: $max_width_cxs) {
        font-size: 10px;
    }
}
</style>
<style lang="scss">
.custom-v-select {
    position: absolute;
    top: -16px;
    right: 0;

    .vs__dropdown-toggle {
        border: none;
    }

    .vs__search {
        display: none;
    }

    .vs__dropdown-option {
        padding: 3px;
        text-align: center;
    }

    .vs__dropdown-menu {
        min-width: auto;
        overflow: hidden;
        background: white;
    }

    &.vs--open {
        .vs__selected {
            margin: 0;
            position: relative;
            top: 4px;
        }
    }

    .vs__actions {
        display: none;
    }
}

.site-status {
    background: #000;
    text-align: center;
    color: white;
}
</style>
