import { localeMap } from "../locale/localeMap";
import { Delivery } from "./Contracts/Delivery";
import { translation } from "./TranslationService";

export class DeliveryService {
    private appContext: any;

    constructor(appContext) {
        this.appContext = appContext;
    }

    getShippingToDayString(method: Delivery) {
        const now = new Date();
        const hour = now.getHours();
        const limitParts = method.params.shipping_to_time?.split(":");
        const limitHour = parseInt(limitParts[0]);
        let day;

        if (hour < limitHour) {
            day = new Intl.DateTimeFormat(localeMap[this.appContext.locale], {
                day: "numeric",
                month: "long",
            }).format(now);
        } else {
            const tomorrow = new Date(now);
            tomorrow.setDate(tomorrow.getDate() + 1);
            day = new Intl.DateTimeFormat(localeMap[this.appContext.locale], {
                day: "numeric",
                month: "long",
            }).format(tomorrow);
        }
        return translation.__("checkout.form.delivery_method", { x: day });
    }
}
