<?php

namespace App\Http\Controllers\Profile;

use App\Contracts\UserRepositoryInterface;
use App\Http\Controllers\BaseController;
use App\Http\Requests\AddAddressRequest;
use App\Models\UserAddress;
use Auth;
use Illuminate\Support\Facades\Redirect;

class AddressController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Profile/Address');
    }

    public function addAddress(UserRepositoryInterface $userRepository, AddAddressRequest $request)
    {
        $data = $request->validated();
        if ($data['default']) {
            $userRepository->resetDefaultAddresses($request->user());
        }
        $userRepository->createAddress(
            $request->user(),
            $data['city'],
            $data['street'],
            $data['house'],
            $data['flat'],
            $data['default']
        );
    }

    public function removeAddress(
        UserAddress $userAddress,
        UserRepositoryInterface $userRepository
    ) {
        $userRepository->deleteUserAddress(Auth::user(), $userAddress);
        return Redirect::back()->with('success', 'Address was successfully deleted.');
    }

    public function updateAddress(
        AddAddressRequest $request,
        UserAddress $userAddress,
        UserRepositoryInterface $userRepository
    ) {
        $userRepository->updateUserAddress(Auth::user(), $userAddress, $request->validated());
        return Redirect::back()->with('success', 'Address was successfully deleted.');
    }
}
