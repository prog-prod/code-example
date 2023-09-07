<template>
    <footer class="bg-light">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-5 mb-md-0 text-center text-sm-left">
                        <h4 class="mb-4">{{ __('contact') }}</h4>
                        <p>{{ address }}</p>
                        <p>{{ phones }}</p>
                        <p>{{ emails }}</p>
                        <ul class="list-inline social-icons">
                            <template v-for="(link, key) in socialLinks" :key="key">
                                <li class="list-inline-item">
                                    <template v-if="link.icon">
                                        <a :href="link.url"><i :class="link.icon"></i></a>
                                    </template>
                                    <template v-else-if="link['logo-img']">
                                        <a :href="link.url">
                                            <img :src="asset(link['logo-img'])" alt="">
                                        </a>
                                    </template>
                                </li>
                            </template>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-5 mb-md-0 text-center text-sm-left">
                        <h4 class="mb-4">{{ __('category') }}</h4>
                        <ul class="pl-0 list-unstyled">
                            <li class="mb-2">
                                <Link class="text-color" :href="route('products.index')">Men</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('products.index')">Women</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('products.index')">Kids</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('products.index')">Accessories</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('products.index')">Shoe</Link>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-5 mb-md-0 text-center text-sm-left">
                        <h4 class="mb-4">{{ __('useful_link') }}</h4>
                        <ul class="pl-0 list-unstyled">
                            <li class="mb-2">
                                <Link class="text-color" :href="route('blog')">News & Tips</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('about')">About Us</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('profile.address.index')">Support</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('products.index')">Our Shop</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('contact.index')">Contact Us</Link>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center text-sm-left">
                        <h4 class="mb-4">{{ __('our_policies') }}</h4>
                        <ul class="pl-0 list-unstyled">
                            <li class="mb-2">
                                <Link class="text-color" :href="route('policy')">Privacy Policy</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('terms')">Terms & Conditions</Link>
                            </li>
                            <li class="mb-2">
                                <Link class="text-color" :href="route('profile.dashboard.index')">Free Shipping &
                                    Returns
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 text-center text-md-left mb-4 mb-md-0 align-self-center">
                        <p class="text-white mb-0">{{ __('main.footer.all_rights_reserved', {year}) }}</p>
                    </div>
                    <div class="col-md-2 text-center text-md-left mb-4 mb-md-0">
                        <Logo place="footer"/>
                    </div>
                    <div class="col-md-5 text-center text-md-right mb-4 mb-md-0">
                        <ul class="list-inline">
                            <li class="list-inline-item"><img
                                class="img-fluid rounded atm-card-img"
                                :src=" asset('images/card-1.jpg')" alt="card">
                            </li>
                            <li class="list-inline-item"><img
                                class="img-fluid rounded atm-card-img"
                                :src="asset('images/card-2.jpg')" alt="card">
                            </li>
                            <li class="list-inline-item"><img
                                class="img-fluid rounded atm-card-img"
                                :src="asset('images/card-3.jpg')" alt="card">
                            </li>
                            <li class="list-inline-item"><img
                                class="img-fluid rounded atm-card-img"
                                :src="asset('images/card-4.jpg')" alt="card">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import {Link} from '@inertiajs/vue3';
import Logo from '@/Components/layouts/Logo.vue';
import {asset} from '@/Services/CommonFunctions.ts';

export default {
    name: 'Footer',
    components: {
        Link,
        Logo,
    },
    data: () => ({
        year: new Date().getFullYear(),
    }),
    computed: {
        address() {
            return this.$page.props.settings.layout.address;
        },
        phones() {
            return this.$page.props.settings.layout.phones.split(',').join(',\n');
        },
        emails() {
            return this.$page.props.settings.layout.emails.split(',').join(',\n');
        },
    },
    methods: {asset},
};
</script>

<style lang="scss" scoped>
.social-icons {
    li {
        a {
            img {
                position: relative;
                top: -2px;
                width: 53%;
            }
        }
    }
}
</style>
