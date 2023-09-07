<?php

namespace App\Repositories;

use App\Contracts\AdminRepositoryInterface;
use App\Models\AdminUser;
use App\Models\TelegramChat;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository implements AdminRepositoryInterface
{

    public function getAdminByToken(string $token)
    {
        return AdminUser::query()->where('api_token', $token)->get()->first();
    }

    public function attachChat(AdminUser $adminUser, ?TelegramChat $chat = null): void
    {
        if (!is_null($chat)) {
            $adminUser->telegramChats()->attach($chat->id);
        }
    }

    public function detachChat(AdminUser $adminUser, ?TelegramChat $chat = null): void
    {
        if (!is_null($chat)) {
            $adminUser->telegramChats()->detach($chat->id);
        }
    }

    public function getAdminsWithTelegramChat(): Collection|array
    {
        return AdminUser::query()->whereHas('telegramChats')->get();
    }

    public function getAllAdmins(): Collection
    {
        return AdminUser::all();
    }

    public function getSuperAdmins(): Collection|array
    {
        return AdminUser::query()->where('super', true)->get();
    }
}
