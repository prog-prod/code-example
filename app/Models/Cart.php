<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property User $user
 * @property Collection<CartItem> $items
 *
 * @method static Builder|Cart whereId($value)
 * @method static Builder|Cart whereUserId($value)
 * @method static Builder|Cart whereCreatedAt($value)
 * @method static Builder|Cart whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
