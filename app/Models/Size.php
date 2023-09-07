<?php

namespace App\Models;

use App\Contracts\TranslatableInterface;
use App\Models\Traits\TranslatableTrait;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $key
 * @property int|null $category_id
 * @property string|null $value
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read Collection|CartItem[] $cartItems
 * @property-read int|null $cart_items_count
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 *
 * @method static Builder|Size whereId($value)
 * @method static Builder|Size whereKey($value)
 * @method static Builder|Size whereCategoryId($value)
 * @method static Builder|Size whereValue($value)
 * @method static Builder|Size whereDeletedAt($value)
 * @method static Builder|Size whereCreatedAt($value)
 * @method static Builder|Size whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Size extends Model implements TranslatableInterface
{
    use HasFactory;
    use TranslatableTrait;
    use SoftDeletes;

    protected array $dates = ['deleted_at'];
    protected $with = ['translations'];

    protected $fillable = [
        "key",
        "category_id",
        "value",
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
