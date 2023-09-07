<template>
    <div>
        <a v-if="btnShow" @click.prevent="toggleCollapse">
            {{ textBtn }}
            <i :class="isOpen ? 'ti-arrow-up' : 'ti-arrow-down' " class="ti-arrow-up text-color"></i></a>
        <transition name="slide-down">
            <div v-if="!isOpen">
                <slot></slot>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: 'Collapse',
    props: {
        textBtn: String,
        value: {
            type: Boolean,
            default: false,
        },
        btnShow: Boolean,
    },
    data() {
        return {
            isOpen: this.value,
        };
    },
    watch: {
        value(newValue) {
            this.isOpen = newValue;
        },
        isOpen(newValue) {
            this.$emit('input', newValue);
        },
    },
    methods: {
        toggleCollapse() {
            this.isOpen = !this.isOpen;
        },
    }
};
</script>

<style>
.slide-down-enter-active, .slide-down-leave-active {
    transition: all 0.5s ease;
}

.slide-down-enter, .slide-down-leave-to {
    transform: translateY(-100%);
    opacity: 0;
}
</style>
