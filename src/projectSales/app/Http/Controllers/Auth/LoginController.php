<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\usersModels;
use App\Models\categoryModels;
use App\Models\brandModels;
class LoginController extends Controller
{
    public function showLoginForm()
    
    {
        $brands = brandModels::all();
        $categories = categoryModels::all();
        return view('auth.login',compact('brands','brands'));
    }

    public function login(Request $request)
    {
        // Validate login request
        $this->validateLogin($request);

        // Check if the user exists
        $user = usersModels::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email này chưa được đăng ký.']);
        }

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Check if the user has verified their email
            if ($user->email_verified_at === null) {
                Auth::logout(); // Log out the user if email is not verified
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Vui lòng xác thực email của bạn trước khi đăng nhập.']);
            }

            // Redirect to home if login is successful and email is verified
            return redirect()->route('home');
        }

        // If login fails, redirect back with errors
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['password' => 'Mật khẩu không chính xác']);
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
