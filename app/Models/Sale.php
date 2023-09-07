<?php

namespace App\Models;

use App\Contracts\TranslatableInterface;
use App\Models\Traits\TranslatableTrait;
use Brick\Money\Money;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $key
 * @property int $quantity
 * @property float $percent
 * @property Carbon|null $endDate
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Money $discount
 * @property-read Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read User $user
 *
 * @method static Builder|Sale whereId($value)
 * @method static Builder|Sale whereKey($value)
 * @method static Builder|Sale whereQuantity($value)
 * @method static Builder|Sale wherePercent($value)
 * @method static Builder|Sale whereEndDate($value)
 * @method static Builder|Sale whereDeletedAt($value)
 * @method static Builder|Sale whereCreatedAt($value)
 * @method static Builder|Sale whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Sale extends Model implements TranslatableInterface
{
    use HasFactory;
    use SoftDeletes;
    use TranslatableTrait;

    protected $with = ['translations'];
    protected array $dates = ['deleted_at'];
    protected $casts = [
        'endDate' => 'datetime'
    ];

    protected $fillable = [
        "key",
        "quantity",
        "percent",
        "endDate",
    ];

    // Relations
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_name', 'name');
    }
}
