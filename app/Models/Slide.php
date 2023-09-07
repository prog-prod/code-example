<?php

namespace App\Models;

use App\Contracts\TranslatableInterface;
use App\Models\Traits\TranslatableTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $slider_id
 * @property string|null $image_webp_mobile
 * @property string|null $image_jpg_mobile
 * @property string|null $image_webp_desktop
 * @property string|null $image_jpg_desktop
 * @property string|null $image_jpg
 * @property string|null $link_url
 * @property int|null $order
 * @property-read Slider|null $slider
 * @property-read Collection|Translatable[] $translations
 * @property-read int|null $translations_count
 *
 * @method static Builder|Slide whereId($value)
 * @method static Builder|Slide whereSliderId($value)
 * @method static Builder|Slide whereImageWebpMobile($value)
 * @method static Builder|Slide whereImageJpgMobile($value)
 * @method static Builder|Slide whereImageWebpDesktop($value)
 * @method static Builder|Slide whereImageJpgDesktop($value)
 * @method static Builder|Slide whereImageJpg($value)
 * @method static Builder|Slide whereLinkUrl($value)
 * @method static Builder|Slide whereOrder($value)
 *
 * @mixin Eloquent
 */
class Slide extends Model implements TranslatableInterface
{
    use HasFactory;
    use TranslatableTrait;

    protected $with = [
        'translations'
    ];

    protected $fillable = [
        'slider_id',
        'image_webp_mobile',
        'image_jpg_mobile',
        'image_webp_desktop',
        'image_jpg_desktop',
        'image_jpg',
        'link_url',
        'order',
    ];

    public function getTitleAttribute(): ?string
    {
        return $this->trans('title');
    }

    // Relations
    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }
}
