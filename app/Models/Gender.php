<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @method static Builder|Gender whereId($value)
 * @method static Builder|Gender whereKey($value)
 * @method static Builder|Gender whereCreatedAt($value)
 * @method static Builder|Gender whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'key'
    ];
}
