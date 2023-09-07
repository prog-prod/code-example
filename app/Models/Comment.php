<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property int $commentable_id
 * @property string $commentable_type
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property Model $commentable
 * @property Collection<Comment> $children
 *
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereCommentableId($value)
 * @method static Builder|Comment whereCommentableType($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Comment extends Model
{
    use HasFactory;

    public function page(): MorphTo
    {
        return $this->morphTo('commentable', Page::class);
    }

    public function children(): MorphMany
    {
        return $this->morphMany('commentable', Comment::class)->with('children');
    }
}
