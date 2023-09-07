<template>
    <div class="mb-50">
        <div class="d-flex border">
            <div class="flex-basis-15 d-block d-md-none p-2 p-sm-4 border-right text-center">
                <a
                    :class="!isGrid ? 'text-gray' : 'text-color'"
                    class="d-inline-block px-1"
                    href="#"
                    @click.prevent="toggleLayout"
                >
                    <i class="ti-layout-grid3-alt"></i>
                </a>
                <a
                    :class="isGrid ? 'text-gray' : 'text-color'"
                    class="d-inline-block px-1"
                    href="#"
                    @click.prevent="toggleLayout"
                ><i class="ti-view-list-alt"></i>

                </a
                ><a
                :class="isOpenedFilter ? 'text-gray' : 'text-color'"
                class="d-inline-block px-1 d-lg-none"
                href="#"
                @click.prevent="toggleFilter"
            ><i class="ti-filter"></i>

            </a>
            </div>
            <div class="flex-basis-70 flex-basis-md-85 p-2 p-sm-4 align-self-sm-center">
                <p
                    class="text-gray mb-0"
                    v-html="
                        __('products.showing_results', {
                            from: productsMeta.from || '0',
                            to: productsMeta.to || '0',
                            of: productsMeta.total,
                        })
                    "
                ></p>
            </div>
            <div class="flex-basis-15 p-2 p-sm-4 text-center">
                <Dropdown
                    v-model="sortBy"
                    class="select"
                    :options="sortOptions"
                    label="key"
                    @change="changeSorting"
                />
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import Dropdown from '@/Components/Dropdown.vue';

export default {
    name: 'TopBar',
    props: {
        productsMeta: Array,
    },
    data: () => ({
        sortBy: null,
    }),
    computed: {
        sortOptions() {
            return Object.entries(this.$page.props.settings.sortBy).map(
                ([key, value]) => ({
                    key: this.__(`products.sortBy.${key.toLowerCase()}`),
                    value,
                }),
            );
        },
        ...mapGetters({
            isGrid: 'layout/isGridLayout',
            isOpenedFilter: 'products/isOpenedFilter',
        }),
    },
    methods: {
        ...mapActions({
            setLayout: 'layout/setLayout',
            setOpenedFilter: 'products/setOpenedFilter',
            setFilterSort: 'products/setFilterSort',
            applyFilters: 'products/applyFilters',
        }),
        toggleLayout() {
            this.setLayout(this.isGrid ? 'list' : 'grid');
        },
        toggleFilter() {
            this.setOpenedFilter(!this.isOpenedFilter);
        },
        changeSorting(val) {
            this.sortBy = val;
            this.setFilterSort(this.sortBy.value);
            this.applyFilters();
        },
    },
    components: {
        Dropdown,
    },
    mounted() {
        this.sortBy = this.sortOptions[0];
    },
};
</script>

<style scoped></style>
