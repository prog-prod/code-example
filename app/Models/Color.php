<?php

namespace App\Models;

use App\Contracts\TranslatableInterface;
use App\Models\Traits\TranslatableTrait;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $key
 * @property string $hex_code
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Collection<Product> $products
 * @property Collection<CartItem> $cartItems
 *
 * @method static Builder|Color whereId($value)
 * @method static Builder|Color whereKey($value)
 * @method static Builder|Color whereHexCode($value)
 * @method static Builder|Color whereDeletedAt($value)
 * @method static Builder|Color whereCreatedAt($value)
 * @method static Builder|Color whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Color extends Model implements TranslatableInterface
{
    use HasFactory;
    use TranslatableTrait;
    use SoftDeletes;

    protected array $dates = ['deleted_at'];
    protected $with = ['translations'];

    protected $fillable = [
        "key",
        "hex_code"
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
