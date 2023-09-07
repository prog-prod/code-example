<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserTrashController extends Controller
{
    public function index()
    {
        $deletedUsers = User::onlyTrashed()->paginate(10);

        return view('admin.trash.users', compact('deletedUsers'));
    }

    public function restore(User $user)
    {
        $user->restore();
        return redirect()->route('admin.trash.users.index')->with('success', 'User has been restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->forceDelete();

        return redirect()->route('admin.trash.users.index')->with(['success' => 'User has been destroyed.']);
    }
}
