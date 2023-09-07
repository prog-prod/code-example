<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use Auth;

class UserService implements UserServiceInterface
{

    private \Illuminate\Contracts\Auth\Authenticatable|null|\App\Models\User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function isMyPhoneNumber(string $phone): bool
    {
        if (!$this->user || !$this->user->phone) {
            return false;
        }

        return PhoneConfirmationService::clearPhone($this->user->phone) ===
            PhoneConfirmationService::clearPhone(
                $phone
            );
    }
}
