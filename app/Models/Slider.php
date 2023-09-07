<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property bool $autoplay
 * @property bool $lazyLoad
 * @property int $autoplay_speed
 * @property int $speed
 * @property bool $pause_on_focus
 * @property bool $pause_on_hover
 * @property bool $infinite
 * @property bool $arrows
 * @property bool $dots
 * @property-read Collection|Slide[] $slides
 * @property-read int|null $slides_count
 *
 * @method static Builder|Slider whereId($value)
 * @method static Builder|Slider whereName($value)
 * @method static Builder|Slider whereAutoplay($value)
 * @method static Builder|Slider whereLazyLoad($value)
 * @method static Builder|Slider whereAutoplaySpeed($value)
 * @method static Builder|Slider whereSpeed($value)
 * @method static Builder|Slider wherePauseOnFocus($value)
 * @method static Builder|Slider wherePauseOnHover($value)
 * @method static Builder|Slider whereInfinite($value)
 * @method static Builder|Slider whereArrows($value)
 * @method static Builder|Slider whereDots($value)
 *
 * @mixin Eloquent
 */
class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'autoplay',
        'lazyLoad',
        'autoplay_speed',
        'speed',
        'pause_on_focus',
        'pause_on_hover',
        'infinite',
        'arrows',
        'dots',
    ];

    public function slides(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Slide::class)->orderBy('order');
    }
}
