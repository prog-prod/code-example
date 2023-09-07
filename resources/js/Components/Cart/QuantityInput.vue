<template>
    <div
        v-if="!isLarge"
        class="input-group bootstrap-touchspin bootstrap-touchspin-injected"
    >
        <span class="input-group-btn input-group-prepend">
            <button
                class="btn btn-primary bootstrap-touchspin-down"
                type="button"
                @click="decreaseQuantity"
            >
                -
            </button>
        </span>
        <TextInput
            v-model="quantity"
            type="number"
            :rounded="false"
            class="form-control"
            @input="checkQuantity"
            @change="checkQuantity"
        />
        <span class="input-group-btn input-group-append">
            <button
                class="btn btn-primary bootstrap-touchspin-up"
                type="button"
                @click="increaseQuantity"
            >
                +
            </button>
        </span>
    </div>
    <div
        v-else
        class="input-group bootstrap-touchspin bootstrap-touchspin-injected"
    >
        <TextInput
            v-model="quantity"
            type="number"
            class="quantity mr-sm-2 mb-3 mb-sm-0 form-control"
            @change="checkQuantity"
        />
        <span class="input-group-btn-vertical">
            <button
                class="btn btn-primary bootstrap-touchspin-up angle-up"
                type="button"
                @click="increaseQuantity"
            >
                +
            </button>
            <button
                class="btn btn-primary bootstrap-touchspin-down angle-down"
                type="button"
                @click="decreaseQuantity"
            >
                -
            </button>
        </span>
    </div>
</template>

<script>
import TextInput from '@/Components/TextInput.vue';

export default {
    name: 'QuantityInput',
    components: {TextInput},
    props: {
        isLarge: {
            default: false,
            type: Boolean,
        },
        modelValue: {
            type: Number,
        },
        max: {
            type: Number,
            default: 99,
        },
        min: {
            type: Number,
            default: 1,
        },
    },
    emits: ['update:modelValue'],
    computed: {
        quantity: {
            get() {
                return Number(this.modelValue);
            },
            set(value) {
                this.$emit('update:modelValue', Number(value));
            },
        },
    },
    methods: {
        increaseQuantity() {
            if (this.quantity < this.max) {
                this.quantity += 1;
            }
        },
        decreaseQuantity() {
            if (this.quantity > this.min) {
                this.quantity -= 1;
            }
        },
        checkQuantity() {
            if (this.quantity <= 0) {
                this.quantity = 1;
            }
            if (this.quantity > this.max) {
                this.quantity = this.max;
            }
        },
    },
};
</script>
<style scoped>
.input-group {
    max-width: 140px;
}
</style>
