<?php

namespace App\Contracts;

use App\Models\AdminUser;
use App\Models\TelegramChat;

interface AdminRepositoryInterface
{
    public function getAdminByToken(string $token);

    public function attachChat(AdminUser $adminUser, TelegramChat $chat);

    public function detachChat(AdminUser $adminUser, TelegramChat $chat);

    public function getAdminsWithTelegramChat();

    public function getAllAdmins();

    public function getSuperAdmins();
}
