<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelegramMessage extends Model
{

    protected $fillable = [
        'update_id',
        'message_id',
        'telegram_chat_id',
        'telegram_user_id',
        'text',
        'date'
    ];

    public function telegramUser(): BelongsTo
    {
        return $this->belongsTo(TelegramUser::class);
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(TelegramChat::class);
    }
}
