<template>
    <div class="color">
        <h4 class="mb-3">Shop by Color</h4>
        <ul class="list-inline">
            <li class="list-inline-item mr-4">
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="radio-box bg-magenta"></span>
                </label>
            </li>
            <li class="list-inline-item mr-4">
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="radio-box bg-dark-green"></span>
                </label>
            </li>
            <li class="list-inline-item mr-4">
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="radio-box bg-sky-blue"></span>
                </label>
            </li>
            <li class="list-inline-item mr-4">
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="radio-box bg-red"></span>
                </label>
            </li>
            <li class="list-inline-item mr-4">
                <label class="radio">
                    <input type="radio" name="radio">
                    <span class="radio-box bg-dark"></span>
                </label>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "ColorFilter",
    props: {
        colors: {
            type: Array,
            required: true,
        }
    }
}
</script>

<style scoped>

</style>
