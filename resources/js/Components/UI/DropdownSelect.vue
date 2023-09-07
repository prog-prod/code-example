<template>
    <DropdownSearch
        v-model="model"
        v-bind="{ ...$attrs, options, error }"
        :dropdown-should-open="dropdownShouldOpen"
        @change="onChange"
        @load="onLoad">
    </DropdownSearch>
</template>
<script>
import DropdownSearch from '@/Components/UI/DropdownSearch.vue';

export default {
    name: 'DropdownSelect',
    components: {
        DropdownSearch,
    },
    props: {
        modelValue: {
            required: true,
            validator: (value) => {
                return value === null || typeof value === 'object';
            },
        },
        error: {
            type: String,
            default: '',
            required: false,
        },
        options: {
            required: true,
            type: Array,
        },
    },
    emits: ['update:modelValue', 'load', 'change'],
    computed: {
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
        dropdownShouldOpen({noDrop, open, mutableLoading}) {
            return noDrop ? false : open && !mutableLoading;
        },
        onLoad() {
            this.$emit('load');
        },
        onChange(val) {
            this.$emit('change', val);
        },
    },
};
</script>
<style scoped>

</style>
