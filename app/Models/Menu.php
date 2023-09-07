<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Collection<MenuItem> $items
 *
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereName($value)
 * @method static Builder|Menu whereImage($value)
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
