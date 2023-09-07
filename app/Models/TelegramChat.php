<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TelegramChat extends Model
{

    protected $fillable = [
        'chat_id',
        'first_name',
        'last_name',
        'username',
        'title',
        'type'
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(TelegramMessage::class);
    }

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(AdminUser::class);
    }
}
