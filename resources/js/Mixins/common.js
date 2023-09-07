import { assetStorage, isClient } from "@/Services/CommonFunctions";
import { UserService } from "@/Services/UserService.ts";

export default {
    computed: {
        isClient,
        locale() {
            return this.settings.locale;
        },
        settings() {
            return this.$page.props.settings;
        },
        user() {
            return this.$page.props.auth.user;
        },
        userService() {
            return new UserService(this.$page.props.auth.user);
        },
        socialLinks() {
            return this.$page.props.settings.social_networks;
        },
    },
    methods: {
        isAbsoluteLink(link) {
            if (!link) return link;
            return link.includes("http://") || link.includes("https://");
        },
        url(link) {
            if (!link) return link;
            const locale = this.$page.props.settings.locale;
            return `/${locale}${link}`;
        },
        asset(pathToFile) {
            return `/${pathToFile}`;
        },
        assetStorage(pathToFile) {
            return assetStorage(pathToFile);
        },
        removeHtmlTags(str) {
            return str.replace(/<[^>]*>/g, "");
        },
    },
};
