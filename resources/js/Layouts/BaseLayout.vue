<template>
    <div id="main">
        <template v-if="isClient">
            <notifications position="bottom right" pause-on-hover/>
        </template>
        <Header v-if="$page.props.status !== 404"/>
        <Navigation :menu="$page.props.menu"/>
        <div class="content">
            <slot/>
        </div>
        <Footer/>
    </div>
</template>
<script>
import Header from '@/Components/layouts/Header.vue';
import Footer from '@/Components/layouts/Footer.vue';
import Navigation from '@/Components/layouts/Navigation.vue';
import notifier from '@/Mixins/notifier.js';

export default {
    components: {
        Header,
        Footer,
        Navigation,
    },
    mixins: [
        notifier,
    ],
    computed: {
        isClient() {
            return typeof window !== 'undefined';
        },
    },
    updated() {
        if (this.isClient) {
            $('.navbar-collapse').collapse('hide');
        }
        this.showNotifications();
    },
    mounted() {
        // Load script.js dynamically here
        if (this.isClient) {
            const script = document.createElement('script');
            script.src = '/js/script.js';
            document.head.appendChild(script);
        }
        this.showNotifications();

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
.content {
    min-height: 400px;
}
</style>
