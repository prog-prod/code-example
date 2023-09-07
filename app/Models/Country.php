<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Currency $currency
 *
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereName($value)
 * @method static Builder|Country whereCode($value)
 * @method static Builder|Country whereCreatedAt($value)
 * @method static Builder|Country whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'country_code', 'code');
    }

    public function currency(): HasOne
    {
        return $this->hasOne(Currency::class);
    }
}
