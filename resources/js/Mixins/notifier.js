export default {
    methods: {
        notifySuccess(text) {
            this.$notify({
                text,
                type: "success",
            });
        },
        notifyError(text) {
            this.$notify({
                text,
                type: "error",
            });
        },
        notifyInfo(text) {
            this.$notify({
                text,
                type: "info",
            });
        },
    },
};
