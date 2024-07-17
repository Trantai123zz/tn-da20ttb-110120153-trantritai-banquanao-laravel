<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\adminModels;
use Illuminate\Support\Facades\Hash;
class adminControlllers extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_ad');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Tìm admin theo username
        $admin = adminModels::where('username', $credentials['username'])->first();

        // Kiểm tra mật khẩu
        if ($admin && $admin->password === $credentials['password']) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
