<template>
    <div>
        <div class="filters-popup" :class="{shift: isOpenedFilter}">
            <a class="close-filters" @click.prevent="toggleFilter">Фільтр:</a>
            <ProductsSidebar v-bind="{categories, filters}"/>
        </div>
        <div v-show="isOpenedFilter" class="curtain-back" @click="toggleFilter"></div>
    </div>
</template>

<script>
import ProductsSidebar from '@/Components/Shop/Products/ProductsSidebar.vue';
import {mapActions, mapGetters} from 'vuex';

export default {
    name: 'MobileFiltersCurtain',
    components: {ProductsSidebar},
    props: {
        categories: Array,
        filters: Object,
    },
    data: () => ({
        open: false,
    }),
    computed: {
        ...mapGetters({
            isOpenedFilter: 'products/isOpenedFilter',
        }),
    },
    methods: {
        ...mapActions({
            setOpenedFilter: 'products/setOpenedFilter',
        }),
        toggleFilter() {
            this.setOpenedFilter(!this.isOpenedFilter);
        },
        closeCurtain() {
            this.open = false;
        },
    },
};
</script>

<style lang="scss" scoped>
.curtain-back {
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    min-height: 100vh;
    z-index: 99 !important;
    background-color: rgba(0, 0, 0, 0.5);
}

.filters-popup {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    padding: 30px;
    background-color: #fff;
    transition: all .2s ease-out;
    transform: translateX(-100%);
    z-index: 0;
    overflow: scroll;
    -webkit-overflow-scrolling: touch;

    &.shift {
        z-index: 100;
        box-shadow: 0 0 15px 0 rgba(0, 0, 0, .24);
        transform: translateX(0);
    }

    .close-filters {
        display: inline-block;
        padding-top: 19px;
        padding-left: 21px;
        padding-right: 21px;
        padding-bottom: 19px;
        font-size: 22px;
        letter-spacing: .1em;
        color: #0b0b0b;

        &::after {
            position: absolute;
            right: 0;
            top: 20px;
            display: inline-block;
            vertical-align: -5px;
            margin-right: 19px;
            width: 28px;
            height: 28px;
            background-image: url(/images/icons/close-mini.svg);
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            content: "";
        }
    }
}

@media (max-width: 960px) {
    .filters-popup {
        .close-filters {
            width: 100%;
            font-size: 17px;
            line-height: 32px;
            letter-spacing: normal;
            display: flex;
            align-items: center;
            text-align: center;
            color: #0b0b0b;

            &:before {
                width: 25px;
                height: 25px;
                background-image: url(/images/icons/close-mini.svg);
                margin-right: 19px;
            }
        }

        .shift {
            z-index: 100 !important;
        }
    }
    .filters-popup {
        width: 75%;
    }
}

@media (min-width: 641px) and (max-width: 960px) {
    .filters-popup {
        width: 480px;
    }
}

.filters-popup {
    transform: translateX(-100%);
}
</style>
