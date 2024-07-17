<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usersModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\addressModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\VerifyEmail;
use App\Models\verifyuserModels;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
    
        // Tạo token xác thực
        $token = Str::random(60);
        
        // Lưu token vào bảng user_verifies
        verifyuserModels::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => now()->addHours(24), // Token hết hạn sau 24 giờ
            'email_verify' => $user->email,
        ]);
    
        // Gửi email xác thực với token
        Mail::to($user->email)->send(new VerifyEmail($token));
    
        return redirect()->route('home')->with('message', 'Vui lòng kiểm tra email của bạn để xác thực tài khoản.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
            'province' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'ward' => ['required', 'string', 'max:255'],
            'apartment_number' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        $user = usersModels::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
        ]);

        addressModels::create([
            'user_id' => $user->id,
            'province' => $data['province'],
            'district' => $data['district'],
            'ward' => $data['ward'],
            'apartment_number' => $data['apartment_number'],
        ]);

        return $user;
    }

    public function verifyEmail($token)
    {
        // Tìm bản ghi xác thực dựa trên token
        $userVerify = verifyuserModels::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();
    
        // Kiểm tra xem bản ghi có tồn tại không
        if (!$userVerify) {
            return redirect()->route('home')->withErrors('Token xác thực không hợp lệ hoặc đã hết hạn.');
        }
    
        // Cập nhật người dùng để xác thực email
        $user = usersModels::find($userVerify->user_id);
        
        // Kiểm tra xem người dùng có tồn tại không
        if (!$user) {
            return redirect()->route('home')->withErrors('Người dùng không tồn tại.');
        }
    
        $user->email_verified_at = now();
        $user->save();
    
        // Xóa bản ghi xác thực
        $userVerify->delete();
    
        return redirect()->route('login')->with('message', 'Tài khoản của bạn đã được xác thực!');
    }
    public function showLinkRequestForm()
    {
        return view('auth.fotgotPass');
    }

    public function sendResetLinkEmail(Request $request)
    {
        
        $request->validate(['email' => 'required|email']);

        // Tìm người dùng bằng email
        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user) {
            // Tạo token
            $token = Str::random(60);

            // Gửi email với liên kết đặt lại mật khẩu
            Mail::send('auth.amailforgotp', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Password Reset Link');
            });

            // Lưu token vào bảng users hoặc bảng khác nếu bạn muốn
            DB::table('users')->where('email', $request->email)->update(['remember_token' => $token]);

            return back()->with('status', 'We have e-mailed your password reset link!');
        }

        return back()->withErrors(['email' => 'We can\'t find a user with that e-mail address.']);
    }
    public function showResetForm($token)
    {
        return view('auth.resetPass', ['remember_token' => $token]);
    }
    
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        // Xác thực token
        $user = DB::table('users')->where('email', $request->email)->where('remember_token', $request->token)->first();

        if ($user) {

            DB::table('users')->where('email', $request->email)->update([
                'password' => Hash::make($request->password),
                'remember_token' => null 
            ]);

            return redirect()->route('login')->with('status', 'Your password has been reset!');
        }

        return back()->withErrors(['email' => 'This password reset token is invalid.']);
    }
    
    
    
}
