<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view("admin.auth.login");
    }

    public function login(AdminLoginRequest $request)
    {
        $data = $request->validated();

        if (auth('admin')->attempt($data)) {
            return redirect(route('admin.dashboard'))->with('success', 'You have successfully logged in.');;
        }
        return back()->withInput()->withErrors(['password' => 'Wrong password.']);
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect(route('admin.login'));
    }
}
