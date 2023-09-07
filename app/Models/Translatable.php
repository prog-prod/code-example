<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $locale
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Translatable whereCreatedAt($value)
 * @method static Builder|Translatable whereId($value)
 * @method static Builder|Translatable whereKey($value)
 * @method static Builder|Translatable whereLocale($value)
 * @method static Builder|Translatable whereUpdatedAt($value)
 * @method static Builder|Translatable whereValue($value)
 *
 * @mixin Eloquent
 */
class Translatable extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'locale',
        'key',
        'value',
    ];

    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }
}
