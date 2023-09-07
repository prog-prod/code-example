import { router } from "@inertiajs/core";
import { notify } from "@kyvg/vue3-notification";
import axios, { AxiosRequestConfig } from "axios";
import { HttpMethod } from "./Types/HttpMethod";

export class RequestService {
    private readonly $inertia: typeof router;
    private readonly $notify: typeof notify;
    public readonly axios: typeof axios;

    constructor() {
        this.$inertia = router;
        this.$notify = notify;
        this.axios = axios;
    }

    public send(method: HttpMethod, url: string, data = {}, options = {}) {
        try {
            this.$inertia[method](url, data, {
                onError: (error) => {
                    const text = Object.values(error).join(",");
                    this.$notify({
                        text,
                        type: "error",
                    });
                },
                ...options,
            });
        } catch (error) {
            this.$notify({
                text: error.response.data.message || "An error occurred.",
                type: "error",
            });
            throw error;
        }
    }

    public async sendWithAxios(
        method: HttpMethod,
        url: string,
        data: object = {},
        config: AxiosRequestConfig = {}
    ) {
        try {
            const response = await this.axios.request({
                method,
                url,
                data,
                ...config,
            });
            return response.data;
        } catch (error) {
            this.$notify({
                text: error.message,
                type: "error",
            });
            throw error;
        }
    }
}

export const $request = new RequestService();
