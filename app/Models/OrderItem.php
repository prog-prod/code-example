<?php

namespace App\Models;

use App\Casts\MoneyCast;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $menu_id
 * @property string $key
 * @property string|null $link
 * @property bool $mega
 * @property string|null $image
 * @property int|null $parent_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Menu $menu
 * @property MenuItem|null $parent
 * @property Collection<MenuItem> $children
 *
 * @method static Builder|MenuItem whereId($value)
 * @method static Builder|MenuItem whereMenuId($value)
 * @method static Builder|MenuItem whereKey($value)
 * @method static Builder|MenuItem whereLink($value)
 * @method static Builder|MenuItem whereMega($value)
 * @method static Builder|MenuItem whereImage($value)
 * @method static Builder|MenuItem whereParentId($value)
 * @method static Builder|MenuItem whereCreatedAt($value)
 * @method static Builder|MenuItem whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected array $dates = ['deleted_at'];
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    protected $casts = [
        'price' => MoneyCast::class
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
