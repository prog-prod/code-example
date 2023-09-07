export interface Delivery {
    key: string;
    name: string;
    description: string;
    params: {
        shipping_to_time: string;
    };
}
