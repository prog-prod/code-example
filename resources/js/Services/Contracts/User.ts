import { UserAddress } from "./UserAddress";
import { Country } from "./Country";
import { Order } from "./Order";
import { SexType } from "../Types/SexType";

export interface User {
    addresses: Array<UserAddress>;
    birthday?: string;
    avatar?: string;
    email: string;
    name?: string;
    country?: Country;
    first_name?: string;
    full_name?: string;
    id: number;
    last_name?: string;
    middle_name?: string;
    login?: string;
    orders: Array<Order>;
    phone?: string;
    phone_verified_at?: string;
    sex?: SexType;
}
