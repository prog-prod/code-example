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
 * @property string $name
 * @property int $country_id
 * @property string $code
 * @property string $symbol
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Country $country
 * @property Collection<Product> $products
 *
 * @method static Builder|Currency whereId($value)
 * @method static Builder|Currency whereName($value)
 * @method static Builder|Currency whereCountryId($value)
 * @method static Builder|Currency whereCode($value)
 * @method static Builder|Currency whereSymbol($value)
 * @method static Builder|Currency whereCreatedAt($value)
 * @method static Builder|Currency whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
        'code',
        'symbol'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'currency_name', 'name');
    }
}
