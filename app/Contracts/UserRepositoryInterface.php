<?php

namespace App\Contracts;

use App\Models\User;
use App\Models\UserAddress;

interface UserRepositoryInterface
{
    public function getAllUsers();

    public function createAddress(
        User $user,
        array $city,
        array $street,
        ?string $house = null,
        ?string $flat = null,
        bool $default = false
    );

    public function deleteUserAddress(User $user, UserAddress $userAddress);

    public function updateUserAddress(User $user, UserAddress $userAddress, array $data);

    public function resetDefaultAddresses(User $user);

}
