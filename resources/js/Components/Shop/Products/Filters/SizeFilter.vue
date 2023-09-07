<template>
    <div class="mb-30">
        <h4 class="mb-3">{{ __('products.filter.size.title') }}</h4>
        <form action="#">
            <template v-for="(size, key) in sizes" :key="key">
                <div class="d-flex justify-content-between custom-checkbox">
                    <label class="label">{{ size.name }}
                        <input v-model="sizesModel" type="checkbox">
                        <span class="box"></span>
                    </label>
                    <span class="mt-2">{{ size.products_count }}</span>
                </div>
            </template>
        </form>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';

export default {
    name: 'SizeFilter',
    props: {
        sizes: {
            type: Array,
            required: true,
        },
    },
    data: () => ({
        sizesModel: null,
    }),
    methods: {
        ...mapActions({
            setFilterSizes: 'products/setFilterSizes',
            applyFilters: 'products/applyFilters',
        }),
        applyFilter() {
            this.setFilterSizes(this.sizesModel);
            this.applyFilters(this.$inertia);
        },
    },
    computed: {
        ...mapGetters({
            filter: 'products/filter',
        }),
    },
    watch: {
        sizesModel(val) {
            console.log(val);
        },
    },
};
</script>

<style scoped>

</style>
