<template>
    <div class="d-flex">
        <input
id="check_" v-model="model" type="checkbox" class="checkbox mr-2" v-bind="$attrs"
               @change="updateCheckbox">
        <label for="check_">
            <slot></slot>
        </label>
        <small class="d-block ml-3">
            <slot name="hint"></slot>
        </small>
    </div>
</template>
<script>
export default {
    name: 'CheckboxComponent',
    props: {
        modelValue: {
            required: true,
            validator: (value) => {
                return typeof value === 'boolean' || typeof value === 'number';
            },
        },
    },
    emits: ['update:modelValue', 'change'],
    computed: {
        model: {
            get() {
                return Boolean(this.modelValue);
            },
            set(value) {
                this.$emit('update:modelValue', value);
            },
        },
    },
    methods: {
        updateCheckbox() {
            this.$emit('change', this.model);
        },
    },
};
</script>
<style scoped>

</style>
