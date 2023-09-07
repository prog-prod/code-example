import { User } from "./User";

export interface Review {
    body: String;
    rating: number;
    title: String;
    user: User;
}
