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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $key
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Collection<Category> $categories
 * @property Collection<PrintCategory> $printCategories
 *
 * @method static Builder|Filter whereId($value)
 * @method static Builder|Filter whereKey($value)
 * @method static Builder|Filter whereCreatedAt($value)
 * @method static Builder|Filter whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Filter extends Model implements TranslatableInterface
{
    use HasFactory;
    use TranslatableTrait;

    protected $with = [
        'translations'
    ];

    protected $fillable = [
        'key'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function printCategories(): BelongsToMany
    {
        return $this->belongsToMany(PrintCategory::class)->withTimestamps();
    }

}
