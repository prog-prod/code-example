<template>
    <transition name="fade">
        <div
            v-show="show"
            class="vbox-overlay"
            :class="showClass" style="background: rgba(23, 23, 23, 0.85);"
            @click="closeOnBackdrop"
        >
            <div class="vbox-preloader" style="display: none">
                <div class="sk-double-bounce">
                    <div
                        class="sk-child sk-double-bounce1"
                        style="background-color: rgb(210, 210, 210)"
                    ></div>
                    <div
                        class="sk-child sk-double-bounce2"
                        style="background-color: rgb(210, 210, 210)"
                    ></div>
                </div>
            </div>
            <div class="vbox-container">
                <div
                    class="vbox-content"
                    style="opacity: 1; margin-top: 51px; margin-bottom: 51px"
                >
                    <div
                        class="vbox-inline figlio"
                        style="
                        width: 80%;
                        height: 100%;
                        padding: 0px;
                        background: rgb(255, 255, 255);
                    "
                    >
                        <slot></slot>
                    </div>
                </div>
            </div>
            <div
                class="vbox-close"
                style="color: rgb(210, 210, 210); background-color: rgb(22, 22, 23)"
                @click="close"
            >
                <i class="ti ti-close"></i>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        title: String,
        modelValue: {
            type: Boolean,
            default: false,
        },
    },
    emits: ['update:show', 'input'],
    computed: {
        showClass() {
            return this.show ? 'opacity-1' : 'opacity-0';
        },
        show: {
            get() {
                return this.modelValue;
            },
            set(value) {
                return this.$emit('update:modelValue', value);
            },
        },
    },
    watch: {
        show() {
            if (this.show) {
                document.body.classList.add('vbox-open');
            } else {
                document.body.classList.remove('vbox-open');
            }
        },
    },
    methods: {
        close() {
            this.show = false;
            this.$emit('close');
        },

        closeOnBackdrop(event) {
            if (event.target.classList.contains('vbox-content')) {
                this.close();
            }
        },
    },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.vbox-content {
    animation-duration: 0.6s;
    animation-fill-mode: both;
}

.fade-enter-active .vbox-content {
    animation-name: slideInFromBottom;
}

.fade-leave-active .vbox-content {
    animation-name: slideOutToTop;
}

@keyframes slideInFromBottom {
    0% {
        opacity: 0;
        transform: translateY(20%);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideOutToTop {
    0% {
        opacity: 1;
        transform: translateY(0);
    }
    100% {
        opacity: 0;
        transform: translateY(-20%);
    }
}
</style>
