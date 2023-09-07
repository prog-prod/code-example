<?php

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $api_token
 * @property string $password
 * @property DateTime|null $deleted_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @method static Builder|AdminUser whereId($value)
 * @method static Builder|AdminUser whereName($value)
 * @method static Builder|AdminUser whereEmail($value)
 * @method static Builder|AdminUser wherePassword($value)
 * @method static Builder|AdminUser whereDeletedAt($value)
 * @method static Builder|AdminUser whereCreatedAt($value)
 * @method static Builder|AdminUser whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class AdminUser extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'email',
        'api_token',
        'password',
        'super'
    ];

    public function routeNotificationForTelegram()
    {
        return $this->telegram_chat_id;  // This assumes the model has a telegram_chat_id attribute/column.
    }

    public function telegramChats(): BelongsToMany
    {
        return $this->belongsToMany(TelegramChat::class)->withTimestamps();
    }

    public function attachTelegramChat(?TelegramChat $chat = null): bool
    {
        if (!is_null($chat) && !$this->existTelegramChat($chat)) {
            $this->telegramChats()->attach($chat->id);
            return true;
        }
        return false;
    }

    public function detachTelegramChat(?TelegramChat $chat = null): bool
    {
        if (!is_null($chat) && $this->existTelegramChat($chat)) {
            $this->telegramChats()->detach($chat->id);
            return true;
        }
        return false;
    }

    public function existTelegramChat(?TelegramChat $chat = null): bool
    {
        if (!is_null($chat)) {
            return $this->telegramChats()->where('telegram_chat_id', $chat->id)->exists();
        }

        return false;
    }
}
