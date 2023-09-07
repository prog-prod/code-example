<template>
    <v-select
        v-model="model"
        :options="options"
        :dropdown-should-open="dropdownShouldOpen"
        v-bind="$attrs"
        @search="onSearch"
        @option:selected="changeOption">
        <template #open-indicator="{ attributes }">
            <i v-bind="attributes" class="ti-angle-down"></i>
        </template>
        <template #spinner="{ loading }">
            <div
                v-if="loading"
                style="border-left-color: rgba(88, 151, 251, 0.71)"
                class="vs__spinner"
            >
                The .vs__spinner class will hide the text for me.
            </div>
        </template>
        <slot name="no-options">{{ ('dropdown-select.no-options') }}</slot>
    </v-select>
    <InputError v-if="error" class="text-danger mt-2" :message="error"/>
</template>

<script>
import vSelect from 'vue-select';
import InputError from '@/Components/InputError.vue';

export default {
    name: 'DropdownSearch',
    components: {
        InputError,
        vSelect,
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
    emits: ['update:modelValue', 'change', 'search', 'load'],
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
    mounted() {
        this.$emit('load');
    },
    methods: {
        dropdownShouldOpen(VueSelect) {
            if (this.model !== null) {
                return VueSelect.open;
            }

            return VueSelect.search.length !== 0 && VueSelect.open;
        },
        changeOption(value) {
            this.$emit('change', value);
        },
        onSearch(search, loading) {
            this.$emit('search', search, loading);
        },
    },
};
</script>

<style lang="scss" scoped>
@import "vue-select/dist/vue-select.css";

:deep {
    .vs--disabled {
        .vs__dropdown-toggle {
            background-color: #eaecef;
        }
    }

    .vs__dropdown-toggle {
        border-radius: 40px;
        padding: 0 30px;
        height: 55px;
        width: 100%;
        display: flex;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .vs__dropdown-menu {
        margin-top: 5px;
    }
}
</style>
