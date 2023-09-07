<template>
    <Dropdown class="country" v-bind="{options, modelValue}" @change="changeOption">
        <template #selectedOption="{ option }">
            <img :src="asset(`images/flag_${option}.jpg`)" :alt="option"/>
        </template>
        <template #option="{ option }">
            <img :src="asset(`images/flag_${option}.jpg`)" :alt="option"/>
        </template>
    </Dropdown>
</template>

<script>
import Dropdown from '@/Components/Dropdown.vue';

export default {
    name: 'CountryDropdown',
    components: {
        Dropdown,
    },
    props: {
        options: Array,
        modelValue: Object | String | Number,
    },
    emits: ['change'],
    methods: {
        changeOption(option) {
            this.$emit('change', option);
        },
    },
};
</script>

