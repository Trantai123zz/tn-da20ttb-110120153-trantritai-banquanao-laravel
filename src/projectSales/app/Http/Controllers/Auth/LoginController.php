<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\usersModels;
use App\Models\categoryModels;
use App\Models\brandModels;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Http\RedirectResponse;
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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = usersModels::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('dashboard');
       
            }else{
                $newUser = usersModels::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('my-google')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
