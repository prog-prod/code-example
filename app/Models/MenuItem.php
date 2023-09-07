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
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $menu_id
 * @property string $key
 * @property string|null $link
 * @property bool $mega
 * @property string|null $image
 * @property int|null $parent_id
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Menu $menu
 * @property MenuItem|null $parent
 * @property Collection<MenuItem> $children
 *
 * @method static Builder|MenuItem whereId($value)
 * @method static Builder|MenuItem whereMenuId($value)
 * @method static Builder|MenuItem whereKey($value)
 * @method static Builder|MenuItem whereLink($value)
 * @method static Builder|MenuItem whereMega($value)
 * @method static Builder|MenuItem whereImage($value)
 * @method static Builder|MenuItem whereParentId($value)
 * @method static Builder|MenuItem whereCreatedAt($value)
 * @method static Builder|MenuItem whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class MenuItem extends Model implements TranslatableInterface
{
    use HasFactory;
    use TranslatableTrait;

    protected $with = ['translations', 'children'];

    protected $fillable = ['menu_id', 'key', 'link', 'mega', 'image', 'parent_id'];

    // Relations
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->with('children')->with('children');
    }
}
