<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $avatar
 * @property string $email
 * @property string $password
 * @property string $zip
 * @property DateTime|null $email_verified_at
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Collection<Product> $wishlist
 * @property Collection<Product> $comparisons
 * @property Collection<Category> $comparisonCategories
 * @property Cart $cart
 * @property Customer $customer
 * @property Collection<Review> $reviews
 *
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static bool isPhoneConfirmed()
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected array $dates = ['deleted_at'];
    protected $with = ['wishlist'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birthday',
        'country_code',
        'phone_verified_at',
        'sex',
        'zip',
        'phone',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'birthday' => 'datetime',
        'sex' => 'int'
    ];

    /**
     * Automatically load the cart relationship for the authenticated user whenever they are retrieved from the database.
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::retrieved(function ($user) {
            $user->load('cart.items');
        });
    }

    // Mutators
    public function getFullNameAttribute(): string
    {
        $fullName = '';

        if (!empty($this->first_name) || !empty($this->last_name) || !empty($this->middle_name)) {
            $fullName = trim($this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name);
        } elseif (!empty($this->login)) {
            $fullName = $this->login;
        } elseif (!empty($this->name)) {
            $fullName = $this->name;
        }

        return trim($fullName);
    }

    public function getNameAttribute(): string
    {
        $name = '';

        if (!empty($this->first_name) || !empty($this->last_name)) {
            $name = trim($this->last_name . ' ' . $this->first_name);
        } elseif (!empty($this->login)) {
            $name = $this->login;
        } else {
            $name = $this->email;
        }

        return trim($name);
    }

    // Relations
    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class)->orderBy('id');
    }

    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'wishlists')->withTimestamps()->globalWith();
    }

    public function comparisons(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'comparisons')->withTimestamps()->globalWith();
    }

    public function comparisonCategories(): HasManyThrough
    {
        return $this->hasManyThrough(Category::class, Comparison::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'code', 'country_code');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function orders(): HasManyThrough
    {
        return $this->hasManyThrough(Order::class, Customer::class)->orderByDesc('created_at');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }


    public function isAdmin(): bool
    {
        return $this->role === UserRoleEnum::ADMIN; // assuming you have a 'role' column in your users table that specifies the user's role
    }

    /**
     * Mark the phone as verified.
     *
     * @return bool
     */
    public function verifyPhone(): bool
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasVerifiedPhone(): bool
    {
        return !is_null($this->phone_verified_at);
    }

}
