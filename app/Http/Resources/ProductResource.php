<?php

namespace App\Http\Resources;

use App\Facades\CurrencyFacade;
use Brick\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property Money $price
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "url" => $this->url,
            "name" => $this->name,
            "description" => $this->description,
            "added_in_wishlist" => $this->added_in_wishlist,
            "added_in_comparisons" => $this->added_in_comparisons,
            "discount" => CurrencyFacade::getPriceObject($this->discount),
            "price" => CurrencyFacade::getPriceObject($this->price),
            "price_with_discount" => CurrencyFacade::getPriceObject($this->price_with_discount),
            "sale" => new ProductSaleResource(
                $this->whenLoaded('sales', function () {
                    return $this->sales->first();
                })
            ),
            "stock_quantity" => $this->quantity,
            "views" => $this->views,
            "is_new" => $this->isNew,
            "category" => new CategoryProductResource($this->whenLoaded('category')),
            "size" => new SizeResource($this->whenLoaded('size')),
            "color" => new ColorResource($this->whenLoaded('color')),
            "main_image" => $this->whenLoaded('images', new ProductImageResource($this->mainImage)),
            "images" => $this->whenLoaded('images', ProductImageResource::collection($this->images)),
            "avg_rating" => $this->whenLoaded('reviews', function () {
                return $this->avg_rating;
            }),
            "reviews" => ProductReviewResource::collection($this->whenLoaded('reviews')),
            "features" => ProductFeatureResource::collection($this->whenLoaded('features')),
            "related" => ProductResource::collection($this->whenLoaded('related')),
            "similar" => ProductResource::collection($this->whenLoaded('similarProducts')),
        ];
    }
}
