<template>
    <input
        class="range-track" type="text" :data-slider-max="max"
        data-slider-step="1" :data-slider-value="`[${val}]`"
        :data-value="`${val}`"
        :value="`${val}`"
        style="display: none;"
        @change="updateModelValue">
    <slot name="value"></slot>
</template>

<script>
import 'bootstrap-slider';

export default {
    name: 'Range',
    props: {
        modelValue: {
            type: String,
            default: '0,0',
        },
        currency: {
            default: '$',
            type: String,
        },
        min: {
            type: Number,
            default: 0,
        },
        max: {
            type: Number,
            default: 1000,
        },
    },
    emits: ['update:modelValue'],
    computed: {
        min() {
            return this.modelValue[0];
        },
        val() {
            return `${this.modelValue[0]},${this.modelValue[1]}`;
        },
    },
    mounted() {
        $('.range-track').slider({}).on('change', this.updateModelValue);
    },
    methods: {
        updateModelValue(event) {
            this.$emit('update:modelValue', event.target.value.split(','));
        },
    },
};
</script>

<style scoped>

</style>
