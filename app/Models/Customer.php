<?php

namespace App\Models;

use App\Models\Traits\PhoneableTrait;
use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postal_code
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property User $user
 *
 * @method static Builder|Customer whereId($value)
 * @method static Builder|Customer whereUserId($value)
 * @method static Builder|Customer whereName($value)
 * @method static Builder|Customer whereEmail($value)
 * @method static Builder|Customer wherePhone($value)
 * @method static Builder|Customer whereAddress($value)
 * @method static Builder|Customer whereCity($value)
 * @method static Builder|Customer whereState($value)
 * @method static Builder|Customer whereCountry($value)
 * @method static Builder|Customer wherePostalCode($value)
 * @method static Builder|Customer whereDeletedAt($value)
 * @method static Builder|Customer whereCreatedAt($value)
 * @method static Builder|Customer whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    use PhoneableTrait;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'ip',
        'currency',
        'coordinates',
    ];

    protected array $dates = ['deleted_at'];

    public function routeNotificationForMail($notification): string
    {
        return $this->email;
    }

    public function getFirstNameAttribute(): string
    {
        $names = explode(' ', $this->attributes['name']);

        return end($names);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
