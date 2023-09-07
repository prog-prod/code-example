export default {
    computed: {
        user() {
            return this.$page.props.auth.user;
        },
    },
};
