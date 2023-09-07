<?php

namespace App\Models;

use App\Contracts\FiltersRelationInterface;
use App\Contracts\TranslatableInterface;
use App\Models\Traits\TranslatableTrait;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @property int $id
 * @property string $key
 * @property string|null $image
 * @property int|null $parent_id
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property PrintCategory|null $parent
 * @property Collection<PrintCategory> $children
 * @property Collection<PrintImage> $prints
 * @property Collection<Filter> $filters
 *
 * @method static Builder|PrintCategory whereId($value)
 * @method static Builder|PrintCategory whereKey($value)
 * @method static Builder|PrintCategory whereImage($value)
 * @method static Builder|PrintCategory whereParentId($value)
 * @method static Builder|PrintCategory whereDeletedAt($value)
 * @method static Builder|PrintCategory whereCreatedAt($value)
 * @method static Builder|PrintCategory whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PrintCategory extends Model implements TranslatableInterface, FiltersRelationInterface
{
    use HasFactory;
    use SoftDeletes;
    use TranslatableTrait;
    use NodeTrait;

    protected array $dates = ['deleted_at'];
    protected $fillable = [
        'key',
        'image',
        'parent_id',
    ];
    protected $with = ['children', 'translations'];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    // Scopes
    public function scopeWithChildrenProductsCount(Builder $query): void
    {
        $query->withCount([
            'prints as products_count'
        ])
            ->with([
                'children' => function ($query) {
                    $query->withCount([
                        'prints as products_count'
                    ]);
                }
            ]);
    }

    public function scopeRootCategories(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    // Relations
    public function parent(): BelongsTo
    {
        return $this->belongsTo(PrintCategory::class, 'parent_id');
    }

    public function prints(): HasMany
    {
        return $this->hasMany(PrintImage::class);
    }

    public function filters(): BelongsToMany
    {
        return $this->belongsToMany(Filter::class)->withTimestamps();
    }
}
