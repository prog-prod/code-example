<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Contracts\TranslatableInterface;
use App\Enums\CurrencyEnum;
use App\Enums\LocalesEnum;
use App\Enums\SortEnum;
use App\Facades\ComparisonsFacade;
use App\Facades\CurrencyFacade;
use App\Facades\WishlistFacade;
use App\Models\Traits\TranslatableTrait;
use Awssat\Visits\Visits;
use Brick\Math\RoundingMode;
use Brick\Money\Exception\MoneyMismatchException;
use Brick\Money\Money;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $key
 * @property string|null $slug
 * @property string|null $weight
 * @property string $currency_name
 * @property int $category_id
 * @property int|null $color_id
 * @property int|null $brand_id
 * @property int|null $gender_id
 * @property int|null $size_id
 * @property bool $main
 * @property bool $active
 * @property int $views
 * @property int|null $stock_quantity_product_id
 * @property int $stock_quantity
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * // Mutators
 * @property string $name
 * @property string $description
 * @property bool $addedInWishlist
 * @property int $quantity
 * @property string|int $url
 * @property bool $addedInComparisons
 * @property string|null $categoryHierarchyName
 * @property null|int $avgRating
 * @property int $minorPrice
 * @property ProductImage $mainImage
 * @property Collection<Color> $colors
 * @property Collection<Size> $sizes
 * @property bool $isNew
 * @property ?Sale $sale
 * @property ?Money $discount
 * @property ?Money $priceWithDiscount
 * @property Collection<Product> $similarProducts
 * @property bool $new_until
 * @property Money $price
 * @property Money $minPrice
 * @property Money $maxPrice
 *
 * // relations
 * @property Gender $gender
 * @property ?Product $stockProduct
 * @property Collection<Product> $productsWithMyQuantity
 * @property Collection<Comparison> $comparisons
 * @property Collection<Wishlist> $wishlists
 * @property Collection<Product> $related
 * @property Collection<CartItem> $cartItem
 * @property Visits $visits
 * @property Collection<OrderItem> $orderItems
 * @property Collection<Review> $reviews
 * @property Collection<ProductFeature> $features
 * @property Collection<PrintImage> $prints
 * @property Collection<Tag> $tags
 * @property ?Brand $brand
 * @property Currency $currency
 * @property Collection<Sale> $sales
 * @property Collection<ProductImage> $images
 * @property Category $category
 * @property ?Color $color
 * @property ?Size $size
 *
 * @method static Builder|Product active()
 * @method static Builder|Product filtered()
 * @method static Product globalPaginate()
 * @method static Builder|Product globalWith()
 * @method static Builder|Product popular()
 * @method static Builder|Product resolveRouteBinding($value, $field = null)
 * @method static Builder|Product similar()
 * @method static Builder|Product sorted()
 * @mixin Eloquent
 */
class Product extends Model implements TranslatableInterface
{
    use HasFactory;
    use TranslatableTrait;
    use SoftDeletes;

    protected array $dates = ['deleted_at'];

    protected $with = ['translations'];

    protected $casts = [
        'price' => MoneyCast::class,
        'discount' => MoneyCast::class,
        'min_price' => MoneyCast::class,
        'max_price' => MoneyCast::class,
        'new_until' => 'datetime',
    ];

    protected $fillable = [
        'key',
        'price',
        'slug',
        'weight',
        'currency_name',
        'category_id',
        'color_id',
        'brand_id',
        'gender_id',
        'size_id',
        'main',
        'active',
        'views',
        'stock_quantity_product_id',
        'stock_quantity',
        'visits'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active', 1);
        });
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)->orWhere('id', $value)->first() ?? abort(404);
    }

    // Custom mutators
    public function getAddedInWishlistAttribute(): ?bool
    {
        return WishlistFacade::contains($this);
    }

    public function getQuantityAttribute(): int
    {
        return $this->stockProduct ? $this->stockProduct->stock_quantity : $this->stock_quantity;
    }

    public function getUrlAttribute(): string|int
    {
        return $this->slug ?? $this->id;
    }

    public function getAddedInComparisonsAttribute(): ?bool
    {
        return ComparisonsFacade::contains($this);
    }

    public function getCategoryHierarchyNameAttribute()
    {
        return $this->category?->getHierarchyName();
    }

    public function getAvgRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }

    public function getMinorPriceAttribute($value): int
    {
        return $this->price->getMinorAmount()->toInt();
    }

    public function getMainImageAttribute($value)
    {
        return $this->images->where('main', true)->first() ?? $this->images->first();
    }

    public function getColorsAttribute(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Color::query()
            ->whereIn('id', function ($query) {
                $query->select('color_id')
                    ->from('products')
                    ->where('products.key', $this->key);
            })
            ->get();
    }

    public function getSizesAttribute(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Size::query()->whereIn('id', function ($query) {
            $query->select('size_id')
                ->from('products')
                ->where('products.key', $this->key)
                ->where('products.color_id', $this->color_id);
        })->distinct()->get();
    }

    public function getIsNewAttribute($value): bool
    {
        return $this->new_until >= now();
    }

    public function getSaleAttribute(): ?Sale
    {
        return $this->sales->first();
    }

    public function getDiscountAttribute(): Money|null
    {
        if ($this->sales->isEmpty()) {
            return null;
        }
        $percent = $this->sales->first()->percent / 100;
        return $this->price->multipliedBy($percent, RoundingMode::UP);
    }

    /**
     * @throws MoneyMismatchException
     */
    public function getPriceWithDiscountAttribute(): ?Money
    {
        if (!$this->discount) {
            return null;
        }
        return $this->price->minus($this->discount);
    }

    public function getSimilarProductsAttribute()
    {
        return $this->similar()->get();
    }

    //Scopes
    public function scopeGlobalPaginate(Builder $query)
    {
        return $query->paginate(35);
    }

    public function scopeGlobalWith(Builder $query): Builder
    {
        return $query->with([
            'color',
            'images',
            'features',
            'category',
            'size',
            'sales',
            'reviews',
        ]);
    }

    public function scopeFiltered(Builder $query): void
    {
        $query->when(request('filters.category'), function ($q) {
            $q->where('category_id', request('filters.category'));
        })->when(request('filters.price'), function (Builder $q) {
            $q->whereBetween('price', [
                CurrencyFacade::convertPrice(
                    request('filters.price.from', 0),
                    CurrencyEnum::UAH->value
                )->getMinorAmount()->toInt(),
                CurrencyFacade::convertPrice(
                    request('filters.price.to', 0),
                    CurrencyEnum::UAH->value
                )->getMinorAmount()->toInt(),
            ]);
        })->when(request('filters.brand'), function (Builder $query) {
            $query->where('brand_id', request('brand_id'));
        })->when(request('search'), function (Builder $query) {
            $query->whereHas('translations', function (Builder $query) {
                foreach (LocalesEnum::getValues() as $locale) {
                    $query->where('locale', '=', $locale)
                        ->where('key', '=', 'name')
                        ->where('value', 'like', '%' . request('search') . '%');
                }
            })->orWhere('key', 'like', '%' . request('search') . '%');
        })->where('main', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function scopeSorted(Builder $query)
    {
        return $query->when(
            request('sort', 1) && collect(SortEnum::getValues())->contains((int)request('sort')),
            function (Builder $q) {
                $direction = request()->str('sort')->contains('-') ? 'DESC' : 'ASC';
                $column = collect((int)request('sort'));
                $sortColumn = str(SortEnum::from(request('sort'))->getColumnName());
                switch ($column) {
                    case $column->contains(SortEnum::TOP_PRODUCTS_ASC->value) :
                        $q->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                            ->select('products.*', \DB::raw('AVG(reviews.rating) as avg_rating'))
                            ->groupBy('products.id')
                            ->orderBy($sortColumn->prepend('avg_'), $direction);
                        break;
                    case $column->contains(SortEnum::POPULAR_ASC->value):
                    case $column->contains(SortEnum::ALPHABETICALLY_ASC->value):
                    case $column->contains(SortEnum::NEWEST->value):
                    case $column->contains(SortEnum::FROM_CHEAP_TO_EXPENSIVE_ASC->value):
                        $q->orderBy($sortColumn->prepend('products.'), $direction);
                        break;
                }
            }
        );
    }

    public function scopeSimilar(Builder $query): Builder
    {
        return $query->globalWith()->where('key', $this->key)
            ->where('id', '!=', $this->id);
    }

    // Relations
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function stockProduct(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Product::class, 'id', 'stock_quantity_product_id');
    }

    public function productsWithMyQuantity(): hasMany
    {
        return $this->hasMany(Product::class, 'stock_quantity_product_id');
    }

    public function comparisons(): HasMany
    {
        return $this->hasMany(Comparison::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function related(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'related_products',
            'product_id',
            'related_product_id'
        )->withTimestamps();
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function visits(): \Awssat\Visits\Visits
    {
        return visits($this);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->orderByDesc('created_at');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProductFeature::class);
    }

    public function prints(): BelongsToMany
    {
        return $this->belongsToMany(PrintImage::class)->withTimestamps()->withPivot('position');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_name', 'name');
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class)->orderByDesc('created_at');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order')->orderBy('created_at');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}
