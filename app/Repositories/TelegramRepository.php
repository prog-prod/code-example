<?php

namespace App\Repositories;

use App\Contracts\TelegramRepositoryInterface;
use App\Models\TelegramChat;
use App\Models\TelegramMessage;
use App\Models\TelegramUser;
use Illuminate\Database\Eloquent\Model;

class TelegramRepository implements TelegramRepositoryInterface
{

    public function createOrUpdateTelegramUser(array $data): Model|null
    {
        $conditions = [
            'is_bot' => $data['is_bot'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
        ];

        return TelegramUser::query()->updateOrCreate($conditions, $data);
    }

    public function createOrUpdateTelegramChat(array $data): Model|null
    {
        $conditions = [
            'chat_id' => $data['chat_id'],
        ];
        return TelegramChat::query()->updateOrCreate($conditions, $data);
    }

    public function createTelegramMessage(array $data): Model|null
    {
        $conditions = [
            'message_id' => $data['message_id'],
        ];

        return TelegramMessage::query()->updateOrCreate($conditions, $data);
    }

    public function getChatByChatId(mixed $chatId)
    {
        return TelegramChat::query()->where('chat_id', $chatId)->get()->first();
    }
}
