<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AdminRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminRepositoryInterface $adminRepository)
    {
        $admins = $adminRepository->getAllAdmins();
        $superadmins = $adminRepository->getSuperAdmins();
        return view('admin.admin-users.index', compact('admins', 'superadmins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $admin = AdminUser::create($validated);

        return redirect()->route('admin.admin-users.show', $admin->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminUser $adminUser)
    {
        return view('admin.admin-users.show', compact('adminUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminUser $adminUser)
    {
        return view('admin.admin-users.edit', compact('adminUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminUser $adminUser)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $adminUser->id,
            'password' => 'nullable',
        ]);

        $adminUser->update($validated);

        return redirect()->route('admin.admin-users.show', $adminUser->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminUser $adminUser)
    {
        $adminUser->delete();

        return redirect()->route('admin.admin-users.index');
    }
}
