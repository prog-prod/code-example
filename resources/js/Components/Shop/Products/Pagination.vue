<template>
    <nav>
        <ul class="pagination justify-content-center">
            <li
v-for="link in meta.links" :key="link.label"
                :class="{'page-item': true, 'active': link.active}">
                <Link class="page-link" :href="link.url" v-html="link.label"/>
            </li>
        </ul>
    </nav>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Pagination",
    components: {
        Link,
    },
    props: {
        meta: Object
    }
}
</script>

<style scoped>

</style>
