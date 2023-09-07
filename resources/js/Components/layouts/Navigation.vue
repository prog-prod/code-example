<template>
    <nav
        id="navbar"
        class="navbar navbar-expand-lg navbar-light bg-white w-100"
    >
        <Logo/>

        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
            @click.prevent="clickBurger"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <template v-if="$page.props.status !== 404">
            <div
                id="navbarSupportedContent"
                class="collapse navbar-collapse order-1 order-lg-2"
            >
                <ul class="navbar-nav mx-auto">
                    <template v-for="(item, key1) in menu.items" :key="key1">
                        <template v-if="item.mega">
                            <li class="nav-item dropdown mega-dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    @click.prevent
                                >
                                    {{ item.name }}
                                </a>
                                <div class="dropdown-menu mega-menu">
                                    <template
                                        v-for="(child, key2) in item.children"
                                        :key="key1 + key2"
                                    >
                                        <div
                                            class="mx-1 mega-menu-item"
                                            :class="{'flex-grow-1': groupedChildren(child.children).length > 1}">
                                            <template v-if="!child.link">
                                                <h6>
                                                    {{ child.name }}
                                                </h6>
                                            </template>
                                            <div class="d-flex">
                                                <ul
                                                    v-for="(group, index) in groupedChildren(child.children)"
                                                    :key="index" class="flex-grow-1 pl-0">
                                                    <li v-for="(subChild, subIndex) in group" :key="subIndex">
                                                        <Link :href="url(subChild.link)" class="text-nowrap px-2">{{
                                                                subChild.name
                                                            }}
                                                        </Link>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </template>
                                    <div v-if="item.image" class="mx-3 mega-megu-image">
                                        <img
                                            class="img-fluid w-100"
                                            :src="assetStorage(item.image)"
                                            alt="feature-img"
                                        />
                                    </div>
                                </div>
                            </li>
                        </template>
                        <template v-else-if="item.children.length > 0">
                            <li class="nav-item dropdown view">
                                <a
                                    v-if="!item.link"
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    @click.prevent
                                >
                                    {{ item.name }}
                                </a>
                                <Link
                                    v-else
                                    class="nav-link dropdown-toggle"
                                    :href="url(item.link)"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >{{ item.name }}
                                </Link>
                                <div class="dropdown-menu">
                                    <template
                                        v-for="(child, key) in item.children"
                                        :key="key"
                                    >
                                        <Link
                                            class="dropdown-item"
                                            :href="url(child.link)"
                                        >{{ child.name }}
                                        </Link>
                                    </template>
                                </div>
                            </li>
                        </template>
                        <template v-else>
                            <li class="nav-item">
                                <Link class="nav-link" :href="url(item.link)">{{ item.name }}
                                </Link>
                            </li>
                        </template>
                    </template>
                </ul>
            </div>
            <div class="order-3 navbar-right-elements">
                <div class="d-flex justify-content-end">
                    <!-- search -->
                    <NavigationSearch/>
                    <!-- comparison -->
                    <NavigationComparison/>
                    <!-- wishlist -->
                    <NavigationWishlist/>
                    <!-- cart -->
                    <NavigationCart/>
                </div>
            </div>
        </template>
    </nav>
</template>

<script>
import Logo from '@/Components/layouts/Logo.vue';
import NavigationSearch from '@/Components/layouts/NavigationSearch.vue';
import NavigationCart from '@/Components/layouts/NavigationCart.vue';
import {Link} from '@inertiajs/vue3';
import NavigationComparison from '@/Components/layouts/NavigationComparison.vue';
import NavigationWishlist from '@/Components/layouts/NavigationWishlist.vue';

export default {
    name: 'Navigation',
    components: {
        Logo,
        NavigationSearch,
        NavigationCart,
        Link,
        NavigationComparison,
        NavigationWishlist,
    },
    props: {
        menu: Object,
    },
    mounted() {
        $('.navbar-collapse').on('show.bs.collapse', function() {
            // Do something when navbar is shown
            $('#navbar').addClass('overflow-y-auto');
        }).on('hide.bs.collapse', function() {
            $('#navbar').removeClass('overflow-y-auto');
        });
    },
    methods: {
        // clickBurger() {
        //     $(this).closest('#navbar').css('overflow-y', 'visible');
        //     console.log(123);
        // },
        groupedChildren(children) {
            const chunkSize = 10;
            const groups = [];
            let currentGroup = [];
            for (let i = 0; i < children.length; i++) {

                if (i > 0 && i % chunkSize === 0) {
                    groups.push(currentGroup);
                    currentGroup = [];
                }
                currentGroup.push(children[i]);
            }
            if (currentGroup.length > 0) {
                groups.push(currentGroup);
            }
            return groups;
        },
    },
};
</script>

<style scoped>
.mega-megu-image img {
    max-width: 478px;
}

#navbar {
    max-height: 100%;
}

.overflow-y-auto {
    overflow-y: auto !important;
}
</style>
