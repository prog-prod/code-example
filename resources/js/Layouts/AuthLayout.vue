<template>
    <notifications position="bottom right"/>
    <div class="content">
        <slot/>
    </div>
</template>

<script>
import notifier from '@/Mixins/notifier.js';

export default {
    mixins: [
        notifier,
    ],
    computed: {
        isClient() {
            return typeof window !== 'undefined';
        },
    },
    updated() {
        $('.navbar-collapse').collapse('hide');
        this.showNotifications();
    },
    mounted() {
        // Load script.js dynamically here
        if (this.isClient) {
            const script = document.createElement('script');
            script.src = '/js/script.js';
            document.head.appendChild(script);
            this.showNotifications();
        }
    },
    methods: {
        showNotifications() {
            if (this.$page.props.flash) {
                if (this.$page.props.flash.error) {
                    this.notifyError(this.$page.props.flash.error);
                } else if (this.$page.props.flash.success) {
                    this.notifySuccess(this.$page.props.flash.success);
                }
            }
            if (this.$page.props.errors) {
                for (let error of Object.values(this.$page.props.errors)) {
                    this.notifyError(error);
                }
            }
        },
    },
};
</script>

<style scoped>

</style>
