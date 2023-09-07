<template>
    <!-- Newsletter Modal -->
    <div ref="modal" class="modal fade subscription-modal" tabindex="-1">
        <div class="modal-dialog" :class="`modal-${size}`">
            <!-- modal content start -->
            <div class="modal-content">
                <!-- container start -->
                <div class="container-fluid">
                    <div class="row">
                        <!-- close button -->
                        <button type="button" class="close" aria-label="Close" @click.prevent="hideModal">
                            <span aria-hidden="true">×</span>
                        </button>
                        <slot></slot>
                    </div>
                </div>
                <!-- container end -->
            </div>
            <!-- modal content end -->
        </div>
    </div>
    <!-- /Newsletter Modal -->
</template>

<script>
export default {
    name: 'Modal',
    props: {
        modelValue: {
            required: true,
            type: Boolean,
        },
        size: {
            default: 'lg',
            type: String,
        },
    },
    emits: ['update:modelValue'],
    computed: {
        show: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            },
        },
    },
    watch: {
        show() {
            if (this.show) {
                this.showModal();
            } else {
                this.hideModal();
            }
        },
    },
    mounted() {
        const $this = this;
        $(this.$refs.modal).on('shown.bs.modal', function() {
            $this.show = true;
        });
        $(this.$refs.modal).on('hidden.bs.modal', function() {
            $this.show = false;
        });
    },
    methods: {
        showModal() {
            $(this.$refs.modal).modal('show');

        },
        hideModal() {
            $(this.$refs.modal).modal('hide');
        },
    },
};
</script>

<style scoped>

</style>
