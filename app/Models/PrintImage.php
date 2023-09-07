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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $key
 * @property string|null $image
 * @property int $print_category_id
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Collection<Product> $products
 * @property PrintCategory $category
 *
 * @method static Builder|PrintImage whereId($value)
 * @method static Builder|PrintImage whereKey($value)
 * @method static Builder|PrintImage whereImage($value)
 * @method static Builder|PrintImage wherePrintCategoryId($value)
 * @method static Builder|PrintImage whereDeletedAt($value)
 * @method static Builder|PrintImage whereCreatedAt($value)
 * @method static Builder|PrintImage whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class PrintImage extends Model implements TranslatableInterface
{
    use HasFactory;
    use SoftDeletes;
    use TranslatableTrait;

    protected array $dates = ['deleted_at'];
    protected $with = ['translations'];
    protected $fillable = [
        'key',
        'image',
        'print_category_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('position');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PrintCategory::class, 'print_category_id', 'id', 'print_categories');
    }
}
