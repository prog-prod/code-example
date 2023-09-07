<?php

namespace App\Models;

use App\Http\Resources\ProductResource;
use App\Models\Traits\TranslatableTrait;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $layout_id
 * @property string $slug
 * @property object $sections
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Layout $layout
 * @property Collection<Comment> $comments
 *
 * @method static Builder|Page whereId($value)
 * @method static Builder|Page whereLayoutId($value)
 * @method static Builder|Page whereSlug($value)
 * @method static Builder|Page whereSections($value)
 * @method static Builder|Page whereDeletedAt($value)
 * @method static Builder|Page whereCreatedAt($value)
 * @method static Builder|Page whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    use TranslatableTrait;

    protected $with = [
        'translations'
    ];

    protected $casts = [
        'sections' => 'object'
    ];

    protected $fillable = ['layout_id', 'slug', 'sections'];

    // Attributes
    public function getSectionsStatusesAttribute()
    {
        return collect($this->sections)->map(function ($section) {
            return ucwords(str_replace(['-', '_'], [' '], $section['key'])) .
                ': ' . ($section['active'] ? '<i class="fa fa-plus"></i>' : '<i class="fa fa-minus"></i>');
        })->values()->join('<br/>');
    }

    public function getDealTitleAttribute(): ?string
    {
        return $this->trans('deal_title');
    }

    public function getDealDescriptionAttribute(): ?string
    {
        return $this->trans('deal_description');
    }

    public function getSaleTitleAttribute(): ?string
    {
        return $this->trans('sale_title');
    }

    public function getSaleTextAttribute(): ?string
    {
        return $this->trans('sale_text');
    }

    public function getMetaTitleAttribute(): ?string
    {
        return $this->trans('title');
    }

    public function getMetaDescriptionAttribute(): ?string
    {
        return $this->trans('description');
    }

    public function getMetaKeywordsAttribute(): ?string
    {
        return $this->trans('keywords');
    }

    public function getTitleAttribute(): string
    {
        return ucwords(str_replace(['-', '_'], [' '], $this->slug));
    }

    public function getSectionsAttribute($value): \Illuminate\Support\Collection
    {
        $sections = collect(json_decode($value, true));
        $sections->transform(function ($section, $key) {
            $section['key'] = $key;
            if (isset($section['product_id'])) {
                $product = Product::globalWith()->find($section['product_id']);
                $section['product'] = $product ? new ProductResource($product) : $product;
            }
            if (isset($section['product_ids'])) {
                $section['products'] = ProductResource::collection(
                    Product::globalWith()->whereIn('id', $section['product_ids'])->get()
                );
            }
            return $section;
        });
        return $sections->sort(function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
    }

    // Relations
    public function layout(): BelongsTo
    {
        return $this->belongsTo(Layout::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany('commentable', Comment::class);
    }
}
