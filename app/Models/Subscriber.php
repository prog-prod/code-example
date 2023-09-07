<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static Builder|Subscriber whereId($value)
 * @method static Builder|Subscriber whereEmail($value)
 * @method static Builder|Subscriber whereCreatedAt($value)
 * @method static Builder|Subscriber whereUpdatedAt($value)
 * @method static Builder|Subscriber whereDeletedAt($value)
 *
 * @mixin Eloquent
 */
class Subscriber extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected array $dates = ['deleted_at'];
    protected $fillable = ['email'];
}
