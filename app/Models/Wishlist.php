<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Wishlist newModelQuery()
 * @method static Builder|Wishlist newQuery()
 * @method static Builder|Wishlist query()
 * @method static Builder|Wishlist whereCreatedAt($value)
 * @method static Builder|Wishlist whereId($value)
 * @method static Builder|Wishlist whereProductId($value)
 * @method static Builder|Wishlist whereUpdatedAt($value)
 * @method static Builder|Wishlist whereUserId($value)
 * @method static where(string $string, int $id)
 *
 * @mixin Eloquent
 */
class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
