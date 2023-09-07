<template>
    <label v-if="label" :for="inputId">{{ label }}</label>
    <textarea
        :id="inputId"
        ref="textarea"
        class="form-control"
        :class="{'rounded-0': !rounded}"
        v-bind="$attrs"
        :placeholder="placeholder"
        :value="modelValue"
        @input="updateModelValue($event.target.value)"
    />
</template>

<script>

export default {
    name: 'TextareaComponent',
    props: {
        modelValue: {
            type: String,
            required: true,
        },
        placeholder: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            default: null,
        },
        rounded: {
            type: Boolean,
            default: false,
        },
    },
    emits: ['update:modelValue'],
    data() {
        return {
            inputId: `input-${Math.floor(Math.random() * 10000)}`,
        };
    },
    mounted() {
        if (this.$refs.textarea.getAttribute('autofocus') !== null) {
            this.$refs.textarea.focus();
        }
    },
    methods: {
        updateModelValue(value) {
            this.$emit('update:modelValue', value);
        },
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>

<style scoped>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
