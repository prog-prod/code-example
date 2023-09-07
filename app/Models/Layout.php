<?php

namespace App\Models;

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
 * @property bool $top_ads_status
 * @property string|null $top_ads_link
 * @property string|null $top_ads_bg_color
 * @property string $phones
 * @property string $emails
 * @property string $header_logo
 * @property string $footer_logo
 * @property string $top_ads_image
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Collection<Page> $pages
 *
 * @method static Builder|Layout whereId($value)
 * @method static Builder|Layout whereKey($value)
 * @method static Builder|Layout whereTopAdsStatus($value)
 * @method static Builder|Layout whereTopAdsLink($value)
 * @method static Builder|Layout whereTopAdsBgColor($value)
 * @method static Builder|Layout wherePhones($value)
 * @method static Builder|Layout whereEmails($value)
 * @method static Builder|Layout whereHeaderLogo($value)
 * @method static Builder|Layout whereFooterLogo($value)
 * @method static Builder|Layout whereTopAdsImage($value)
 * @method static Builder|Layout whereDeletedAt($value)
 * @method static Builder|Layout whereCreatedAt($value)
 * @method static Builder|Layout whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Layout extends Model
{
    use HasFactory;
    use TranslatableTrait;
    use SoftDeletes;

    protected $fillable = [
        'key',
        'top_ads_status',
        'top_ads_link',
        'top_ads_bg_color',
        'phones',
        'emails',
        'header_logo',
        'footer_logo',
        'top_ads_image',
    ];
    protected $with = [
        'translations'
    ];
    protected $casts = [
        'header' => 'json',
        'footer' => 'json'
    ];

    // Mutators
    public function getTopHeaderTextAttribute(): ?string
    {
        return $this->trans('top_header_text');
    }

    public function getAddressAttribute(): ?string
    {
        return $this->trans('address');
    }

    // Relations
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
