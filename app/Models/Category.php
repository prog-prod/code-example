<?php

namespace App\Models;

use App\Contracts\FiltersRelationInterface;
use App\Contracts\TranslatableInterface;
use App\Models\Traits\TranslatableTrait;
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
use Nette\Utils\DateTime;

/**
 * @property int $id
 * @property string $key
 * @property string $image
 * @property string $description
 * @property int|null $parent_id
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Collection<Comparison> $comparisons
 * @property Category|null $parent
 * @property Collection<Category> $children
 * @property Collection<Size> $sizes
 * @property Collection<Product> $products
 * @property Collection<Filter> $filters
 *
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereKey($value)
 * @method static Builder|Category whereImage($value)
 * @method static Builder|Category whereDescription($value)
 * @method static Builder|Category whereParentId($value)
 * @method static Builder|Category whereDeletedAt($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static whereIn(string $string, int[]|string[] $categories)
 *
 * @mixin Eloquent
 */
class Category extends Model implements TranslatableInterface, FiltersRelationInterface
{
    use HasFactory;
    use TranslatableTrait;
    use SoftDeletes;
    use NodeTrait;

    protected array $dates = ['deleted_at'];

    protected $with = ['translations', 'children'];

    protected $fillable = [
        'key',
        'image',
        'description',
        'parent_id',
    ];

    public function getRouteKeyName()
    {
        return 'key';
    }

    // Scopes
    public function scopeWithChildrenProductsCount(Builder $query)
    {
        $query->withCount('products')
            ->with([
                'children' => function ($query) {
                    $query->withCount('products');
                }
            ]);
    }

    public function scopeRootCategories(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    // Relations
    public function comparisons(): HasMany
    {
        return $this->hasMany(Comparison::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(Size::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function filters(): BelongsToMany
    {
        return $this->belongsToMany(Filter::class)->withTimestamps();
    }

    public function getHierarchyName()
    {
        $categoryHierarchy = $this->name;
        $parent = $this->parent;
        while ($parent) {
            $categoryHierarchy = $parent->name . ' - ' . $categoryHierarchy;
            $parent = $parent->parent;
        }
        return $categoryHierarchy;
    }
}
