import {Price} from "./Price";

export interface Sale {
    discount: Price;
    endDate: String;
    percent: number;
    quantity: number;
}
