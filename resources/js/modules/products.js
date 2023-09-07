import { $request } from "@/Services/RequestService";

const state = {
    filter: {
        price: {},
        sizes: [],
    },
    sortBy: null,
    quickViewProduct: null,
    isShowQuickView: false,
    openedFilter: false,
    loadMore: false,
    productsData: [],
};

const mutations = {
    setFilter(state, filter) {
        state.filter = filter;
        //localStorage.setItem('product-filter', JSON.stringify(filter))
    },
    setOpenedFilter(state, status) {
        state.openedFilter = status;
    },
    setSortBy(state, sortBy) {
        state.sortBy = sortBy;
    },
    setLoadMore(state, loadMore) {
        state.loadMore = loadMore;
    },
    setProductsData(state, productsData) {
        if (state.loadMore) {
            state.productsData = [...state.productsData, ...productsData];
        } else {
            state.productsData = productsData;
        }
    },
    setQuickViewProduct(state, product) {
        state.quickViewProduct = product;
    },
    setIsShowQuickView(state, show) {
        state.isShowQuickView = show;
    },
};

const actions = {
    setFilter({ commit }, layout) {
        commit("setFilter", layout);
    },
    setOpenedFilter({ commit }, status) {
        commit("setOpenedFilter", status);
    },
    setFilterPrice({ commit }, { from, to }) {
        state.filter.price.from = from;
        state.filter.price.to = to;

        commit("setFilter", state.filter);
    },
    setFilterSizes({ commit }, sizes) {
        state.filter.sizes = [...state.filter.sizes, ...sizes];
        commit("setFilter", state.filter.sizes);
    },
    setFilterSort({ commit }, sortBy) {
        commit("setSortBy", sortBy);
    },
    setLoadMore({ commit }, loadMore) {
        commit("setLoadMore", loadMore);
    },
    setProductsData({ commit }, productsData) {
        commit("setProductsData", productsData);
    },
    setQuickViewProduct({ commit }, product) {
        commit("setQuickViewProduct", product);
    },
    toggleQuickView({ commit, state }, toggle = null) {
        commit("setIsShowQuickView", toggle ? toggle : !state.isShowQuickView);
    },
    applyFilters({ commit }) {
        $request.send(
            "get",
            route(route().current(), route().params),
            {
                filters: state.filter,
                ...(state.sortBy && { sort: state.sortBy }),
            },
            {
                preserveScroll: true,
            }
        );
    },
};

const getters = {
    filter: (state) => state.filter,
    quickViewProduct: (state) => state.quickViewProduct,
    isShowQuickView: (state) => state.isShowQuickView,
    isOpenedFilter: (state) => state.openedFilter,
    productsData: (state) => state.productsData,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};
