<template>
    <img src="/images/Spinner-1s-200px.svg" alt="" :width="width">
</template>
<script>
export default {
    name: 'Spinner',
    props: {
        width: {
            type: Number,
            default: 200,
        },
    },
};
</script>
<style scoped>

</style>
