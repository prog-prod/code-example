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
 * @property string $name_ua
 * @property string $name_en
 * @property string $description
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Collection<Product> $products
 * @property Collection<Translatable> $translations
 *
 * @method static Builder|Brand whereId($value)
 * @method static Builder|Brand whereKey($value)
 * @method static Builder|Brand whereNameUa($value)
 * @method static Builder|Brand whereNameEn($value)
 * @method static Builder|Brand whereDescription($value)
 * @method static Builder|Brand whereDeletedAt($value)
 * @method static Builder|Brand whereCreatedAt($value)
 * @method static Builder|Brand whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Brand extends Model implements TranslatableInterface
{
    use HasFactory;
    use TranslatableTrait;
    use SoftDeletes;

    protected $with = ['translations'];

    protected $dates = ['deleted_at'];
    protected $fillable = [
        "key",
        "name_ua",
        "name_en",
        'description'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
