<template>
    <div class="mb-30">
        <h4 class="mb-4">{{ __('products.filter.price.title') }}</h4>
        <RangeTrack
ref="range-track" v-model="rangePrice" :currency="currency" :min="minPriceLimit"
                    :max="maxPriceLimit"/>
        <div class="d-flex justify-content-between">
            <button class="btn btn-sm btn-primary" @click.prevent="applyFilter">{{
                    __('products.filter.price.btn')
                }}
            </button>
            <span ref="range-track-value" class="range-track-value">
                {{ price.minPrice.amount }} {{ price.maxPrice.symbol }} -
                {{ price.maxPrice.amount }} {{ price.maxPrice.symbol }}
            </span>
        </div>
    </div>
</template>

<script>
import RangeTrack from "@/Components/UI/RangeTrack.vue";
import {mapActions} from "vuex";

export default {
    name: "PriceFilter",
    props: {
        price: {
            type: Object,
            required: true,
        }
    },
    data: () => ({
        rangePrice: []
    }),
    methods: {
        ...mapActions({
            setFilterPrice: 'products/setFilterPrice',
            applyFilters: 'products/applyFilters'
        }),
        applyFilter() {
            this.setFilterPrice({from: this.rangePrice[0], to: this.rangePrice[1]})
            this.applyFilters(this.$inertia);
        }
    },
    computed: {
        minPriceLimit() {
            return this.$page.props.settings.filter.minPrice.amount;
        },
        maxPriceLimit() {
            return this.$page.props.settings.filter.maxPrice.amount;
        },
        minPrice() {
            return this.price.minPrice.amount;
        },
        maxPrice() {
            return this.price.minPrice.amount;
        },
        currency() {
            return this.price.maxPrice.symbol
        }
    },
    components: {
        RangeTrack
    },
    created() {
        this.rangePrice = [this.price.minPrice.amount, this.price.maxPrice.amount];
    },
    mounted() {
        const $rangeVal = $(this.$refs['range-track-value']);
        const currency = this.currency;
        $(".range-track").on("slide", (function (e) {
            $rangeVal.text(`${e.value[0]} ${currency} - ${e.value[1]} ${currency}`)
        }))
    }
}
</script>

<style scoped>

</style>
