<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Storage;

class ProfileDetailsController extends BaseController
{

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();
        if (!$validated['avatar']) {
            unset($validated['avatar']);
        }
        $user->fill($validated);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('public/avatars');
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        return Redirect::back()->with('success', 'User was successfully updated.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Profile/ProfileDetails');
    }
}
