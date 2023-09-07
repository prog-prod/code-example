<script setup>
defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="btn btn-primary"
        :class="{disabled}"
        :disabled="disabled"
    >
        <slot/>
    </button>
</template>

<style scoped>
.white-space-normal {
    white-space: normal;
}
</style>
