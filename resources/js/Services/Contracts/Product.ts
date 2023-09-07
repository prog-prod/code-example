import { Price } from "./Price";
import { Sale } from "./Sale";
import { ProductImage } from "./ProductImage";
import { Color } from "./Color";
import { Size } from "./Size";
import { Review } from "./Review";
import { ProductFeature } from "./ProductFeature";

export interface Product {
    id: number;
    name: string;
    added_in_comparisons: Boolean;
    added_in_wishlist: Boolean;
    avg_rating: String;
    key: string;
    slug: string;
    gender: string;
    images: Array<ProductImage>;
    main_image: ProductImage;
    is_new: Boolean;
    price: Price;
    color: Color;
    colors: Array<Color>;
    size: Size;
    sizes: Array<Size>;
    price_with_discount: Price;
    sale: Sale;
    stock_quantity: number;
    views: number;
    related: Array<Product>;
    reviews: Array<Review>;
    features: Array<ProductFeature>;
}
