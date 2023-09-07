<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property string $product_name
 * @property float $product_price
 * @property int $quantity
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Cart $cart
 * @property Product $product
 *
 * @method static Builder|CartItem whereId($value)
 * @method static Builder|CartItem whereCartId($value)
 * @method static Builder|CartItem whereProductId($value)
 * @method static Builder|CartItem whereProductName($value)
 * @method static Builder|CartItem whereProductPrice($value)
 * @method static Builder|CartItem whereQuantity($value)
 * @method static Builder|CartItem whereCreatedAt($value)
 * @method static Builder|CartItem whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity'
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
