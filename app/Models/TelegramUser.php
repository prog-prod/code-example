<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TelegramUser extends Model
{
    protected $fillable = [
        'telegram_id',
        'is_bot',
        'first_name',
        'last_name',
        'username',
        'language_code',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(TelegramMessage::class);
    }
}
