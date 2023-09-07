<template>
    <div v-if="paginator.hasPages() && paginator.hasMorePages()">
        <PrimaryButton @click="loadProducts"><i class="ti ti-reload"></i> {{ __('products.load_more_btn') }}
        </PrimaryButton>
    </div>
</template>
<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Paginator} from '@/Services/Paginator.ts';
import {mapActions} from 'vuex';

export default {
    name: 'LoadMoreButton',
    components: {PrimaryButton},
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
    methods: {
        ...mapActions({
            setLoadMore: 'products/setLoadMore',
        }),
        loadProducts() {
            if (this.meta.current_page < this.meta.last_page) {
                if (this.paginator.hasMorePages()) {
                    this.setLoadMore(true);
                    this.$inertia.visit(this.paginator.nextPageUrl(), {
                        preserveScroll: true,
                        onFinish: () => {
                            this.setLoadMore(false);
                        },
                    });
                }
            }
        },
    },
};
</script>
<style scoped>

</style>
