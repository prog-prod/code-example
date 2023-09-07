<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property int $rating
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
 * @property-read User $user
 *
 * @method static Builder|Review whereId($value)
 * @method static Builder|Review whereProductId($value)
 * @method static Builder|Review whereUserId($value)
 * @method static Builder|Review whereTitle($value)
 * @method static Builder|Review whereBody($value)
 * @method static Builder|Review whereRating($value)
 * @method static Builder|Review whereDeletedAt($value)
 * @method static Builder|Review whereCreatedAt($value)
 * @method static Builder|Review whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Review extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected array $dates = [
        'deleted_at',
        'created_at'
    ];
    protected $fillable = [
        'product_id',
        'user_id',
        'body',
        'rating'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
