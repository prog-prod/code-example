<?php

namespace App\Http\Controllers\Auth;

use App\Facades\PhoneConfirmationFacade;
use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\PhoneConfirmationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

class RegisteredUserController extends BaseController
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return $this->showView('Auth/Register', [
            'isVerifiedPhone' => session('isVerifiedPhone')
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request, PhoneConfirmationService $phoneConfirmationService): RedirectResponse
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'phone' => [
                'required',
                'unique:users,phone',
                'size:' . PhoneConfirmationFacade::getPhoneLength()
            ],
            'confirm_phone_code' => 'required|size:' . PhoneConfirmationFacade::getPhoneCodeLength(),
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!$phoneConfirmationService->checkPhoneVerification($request->phone, $request->confirm_phone_code)) {
            return back()->withInput()->withErrors(['phone' => __('messages.phone_is_not_verified')]);
        }

        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $user->verifyPhone();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
