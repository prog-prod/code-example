<template>
    <div id="accordionExample" class="accordion">
        <div>
            <slot>123</slot>
            <slot name="accordion-body"></slot>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Accordion',

};
</script>

<style scoped>

</style>
