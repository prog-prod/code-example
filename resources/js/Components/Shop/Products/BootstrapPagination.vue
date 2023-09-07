<template>
    <nav v-if="paginator.hasPages()">
        <ul class="pagination">
            <!-- Previous Page Link -->
            <li
                v-if="paginator.onFirstPage()" class="page-item disabled" aria-disabled="true"
                :aria-label="__('pagination.prev')">
                <span class="page-link big" aria-hidden="true">{{ __('pagination.prev') }}</span>
            </li>
            <li v-else class="page-item">
                <Link
                    class="page-link big" :href="paginator.previousPageUrl()" rel="prev"
                    :preserve-scroll="true"
                    :aria-label="__('pagination.prev')">{{ __('pagination.prev') }}
                </Link>
            </li>

            <!-- Pagination Elements -->
            <template v-for="element in paginator.elements">
                <!-- "Three Dots" Separator -->
                <li v-if="typeof element === 'string'" class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ element }}</span>
                </li>

                <!-- Array Of Links -->
                <template v-else>
                    <li
                        v-for="(url, page) in element" :key="page"
                        :class="{ 'page-item': true, 'active': paginator.currentPage() === Number(page) }"
                        :aria-current="paginator.currentPage() === page ? 'page' : null">
                        <Link class="page-link" :preserve-scroll="true" :href="url">{{ page }}</Link>
                    </li>
                </template>
            </template>

            <!-- Next Page Link -->
            <li v-if="paginator.hasMorePages()" class="page-item">
                <Link
                    class="page-link big" :href="paginator.nextPageUrl()" rel="next"
                    :preserve-scroll="true"
                    :aria-label="__('pagination.next')">{{ __('pagination.next') }}
                </Link>
            </li>
            <li v-else class="page-item disabled" aria-disabled="true" :aria-label="__('pagination.next')">
                <span class="page-link big" aria-hidden="true">{{ __('pagination.next') }}</span>
            </li>
        </ul>
    </nav>
</template>

<script>
import {Paginator} from '@/Services/Paginator';
import {Link} from '@inertiajs/vue3';

export default {
    name: 'BootstrapPagination',
    components: {
        Link,
    },
    props: {
        meta: {
            type: Object,
            required: true,
        },
    },
    computed: {
        paginator() {
            return new Paginator(this.meta);
        },
    },
};
</script>

<style scoped>
.pagination {
    justify-content: center;
}
</style>
