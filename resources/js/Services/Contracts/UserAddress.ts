import { UserStreet } from "./UserStreet";
import { UserCity } from "./UserCity";

export interface UserAddress {
    id: number;
    street: UserStreet;
    house?: string;
    flat?: string;
    full_address: string;
    default: boolean | 1 | 0;
    created_at: string;
    city: UserCity;
}
