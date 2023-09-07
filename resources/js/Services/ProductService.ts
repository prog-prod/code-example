import { Product } from "./Contracts/Product";
import { DropdownValue } from "./Contracts/DropdownValue";
import { $request } from "./RequestService";
import { assetStorage } from "./CommonFunctions";

export class ProductService {
    product: Product | null;
    defaultProductImage: "images/default-product.png";

    constructor(product: Product) {
        this.product = product;
    }

    getProductLink(product?: Product) {
        let productToUse = product || this.product;
        let id = null;
        if (productToUse) {
            id = productToUse.slug || productToUse.id;
            return route("products.show", id);
        }
        // handle the case when productToUse is null
        return null;
    }

    getProductImagePath(product?: Product) {
        let productToUse = product || this.product;
        const mainImage = this.getMainImage(productToUse);
        return mainImage
            ? assetStorage(mainImage)
            : assetStorage(this.defaultProductImage);
    }

    getMainImage(product?: Product) {
        let productToUse = product || this.product;
        if (productToUse) {
            return productToUse.images.find((image) => image.main)?.filename;
        }
        // handle the case when productToUse is null
        return null;
    }

    redirectToProduct(
        similarProducts: Array<Product>,
        selectedSize: DropdownValue,
        selectedColor: DropdownValue
    ) {
        let product = similarProducts.find(
            (product) =>
                product.size?.id === selectedSize?.value &&
                product.color?.id === selectedColor?.value
        );

        if (!product) {
            product = similarProducts.find(
                (product) => product.color?.id === selectedColor?.value
            );
        }

        if (product) {
            const route = this.getProductLink(product);
            if (route) {
                $request.send(
                    "get",
                    route,
                    {},
                    {
                        preserveScroll: true,
                    }
                );
            }
        }
    }
}
