<?php

namespace App\Models;

use App\Contracts\TranslatableInterface;
use App\Enums\LocalesEnum;
use App\Models\Traits\TranslatableTrait;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Product $product
 * @property-read string|null $text
 * @property-read string|null $name
 * @property-read string|null $text_uk
 * @property-read string|null $name_uk
 * @property-read string|null $text_en
 * @property-read string|null $name_en
 *
 * @method static Builder|ProductFeature whereId($value)
 * @method static Builder|ProductFeature whereProductId($value)
 * @method static Builder|ProductFeature whereCreatedAt($value)
 * @method static Builder|ProductFeature whereUpdatedAt($value)
 * @method void addTranslations(array $data, string $columns_group)
 *
 * @mixin Eloquent
 */
class ProductFeature extends Model implements TranslatableInterface
{
    use HasFactory;
    use TranslatableTrait;

    protected $fillable = [
        "product_id",
    ];

    protected $with = [
        'translations'
    ];

    //Attributes
    public function getTextAttribute(): ?string
    {
        return $this->trans('text');
    }

    public function getNameAttribute(): ?string
    {
        return $this->trans('name');
    }

    public function getTextUkAttribute(): ?string
    {
        return $this->trans('text', LocalesEnum::UA->value);
    }

    public function getNameUkAttribute(): ?string
    {
        return $this->trans('name', LocalesEnum::UA->value);
    }

    public function getTextEnAttribute(): ?string
    {
        return $this->trans('text', LocalesEnum::EN->value);
    }

    public function getNameEnAttribute(): ?string
    {
        return $this->trans('name', LocalesEnum::EN->value);
    }

    // Relations
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
