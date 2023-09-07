<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{

    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function resetDefaultAddresses(User $user): void
    {
        $user->addresses()->update([
            'default' => false
        ]);
    }

    public function createAddress(
        User $user,
        array $city,
        array $street,
        ?string $house = null,
        ?string $flat = null,
        bool $default = false
    ): Model {
        return $user->addresses()->updateOrCreate([
            'city' => $city,
            'street' => $street,
            'house' => $house,
            'flat' => $flat,
            'default' => $default,
        ]);
    }

    public function deleteUserAddress(User $user, UserAddress $userAddress): void
    {
        $user->addresses()->whereId($userAddress->id)->delete();
    }

    public function updateUserAddress(User $user, UserAddress $userAddress, array $data): void
    {
        if (isset($data['default']) && $data['default']) {
            $this->resetDefaultAddresses($user);
        }
        $user->addresses()->whereId($userAddress->id)->update($data);
    }
}
