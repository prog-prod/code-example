const state = {
    layout: getLayoutFromLocalStorage() || "grid",
    openedCart: false,
};

const mutations = {
    setLayout(state, layout) {
        state.layout = layout;
        setLayoutToLocalStorage(layout);
    },
    setOpenedCart(state, openedCart) {
        state.openedCart = openedCart;
    },
};

const actions = {
    setLayout({ commit }, layout) {
        commit("setLayout", layout);
    },
    toggleCart({ commit, state }, toggle = null) {
        commit("setOpenedCart", toggle ? toggle : !state.openedCart);
    },
};

const getters = {
    isGridLayout: (state) => state.layout === "grid",
    isOpenedCart: (state) => state.openedCart,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};

function getLayoutFromLocalStorage() {
    if (typeof window !== "undefined") {
        // Check if code runs on client side
        return localStorage.getItem("layout");
    }
    return null;
}

function setLayoutToLocalStorage(layout) {
    if (typeof window !== "undefined") {
        // Check if code runs on client side
        localStorage.setItem("layout", layout);
    }
}
