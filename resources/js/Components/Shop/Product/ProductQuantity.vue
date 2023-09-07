<template>
    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
        <TextInput
            v-model="quantity"
            class="quantity mr-sm-2 mb-3 mb-sm-0 form-control"
            @change="checkQuantity"
        />
        <span class="input-group-btn-vertical">
            <button
                class="btn btn-primary bootstrap-touchspin-up angle-up"
                type="button"
            >
                +
            </button>
            <button
                class="btn btn-primary bootstrap-touchspin-down angle-down"
                type="button"
            >
                -
            </button>
        </span>
    </div>
</template>

<script>
import TextInput from '@/Components/TextInput.vue';

export default {
    name: 'ProductQuantity',

    components: {
        TextInput,
    },
    emits: ['update:modelValue'],
    computed: {
        quantity: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            },
        },
    },
    methods: {
        checkQuantity() {
            if (this.quantity > this.max) {
                this.quantity = this.max;
            }
        },
    },
};
</script>

<style scoped></style>
