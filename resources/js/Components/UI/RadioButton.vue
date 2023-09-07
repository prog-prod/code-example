<template>
    <div>
        <input
            :id="inputId"
            v-model="model"
            v-bind="$attrs"
            :value="value"
            class="custom-checkbox"
            type="radio"
            :checked="model === value"
            @change="updateRadio"
        >
        <label v-if="label" :for="`${inputId}`">{{ label }}</label>
        <small v-if="description" class="d-block ml-3">{{ description }}</small>
        <InputError v-if="error" class="text-danger mt-2" :message="error"/>
    </div>
</template>
<script>
import InputError from '@/Components/InputError.vue';

export default {
    name: 'RadioButton',
    components: {InputError},
    props: {
        label: {
            type: String,
            required: false,
        },
        description: {
            type: String,
            required: false,
        },
        modelValue: {
            required: true,
            validator: (value) => {
                return value === null || typeof value === 'object' || typeof value === 'string';
            },
        },
        error: {
            type: String,
            default: '',
            required: false,
        },
        value: {
            required: true,
            validator: (value) => {
                return value === null || typeof value === 'object' || typeof value === 'string';
            },
        },
    },
    emits: ['update:modelValue', 'change'],
    computed: {
        inputId: () => `input-${Math.floor(Math.random() * 10000)}`,
        model: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            },
        },
    },
    methods: {
        updateRadio() {
            this.$emit('change', this.model);
        },
    },
};
</script>

<style scoped>
.custom-checkbox {
    margin-right: 10px;
}
</style>
