<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\verifyuserModels;
use App\Models\usersModels;
use Illuminate\Support\Carbon;

class emailverifyuserControllers extends Controller
{
    public function verify($token)
    {
        //$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $verifyUser = verifyuserModels::where('token', $token)->first();
       
        // Kiểm tra xem verifyUser có tồn tại không
        if ($verifyUser) {
            // Tìm người dùng dựa trên user_id trong verifyuserModels
            $user = usersModels::find($verifyUser->user_id);

            // Kiểm tra xem người dùng có tồn tại không
            if ($user) {
                if (!$user->email_verified_at) {
                    // Cập nhật trường email_verified_at của người dùng
                    $user->email_verified_at = now();
                    $user->save();

                    // Xóa thông tin xác thực để không dùng lại token
                    $verifyUser->delete();

                    return redirect()->route('login')->with('message', 'Your email has been verified.');
                } else {
                    return redirect()->route('login')->with('message', 'Your email is already verified.');
                }
            } else {
                return redirect()->route('login')->with('error', 'User not found.');
            }
        }

        return redirect()->route('login')->with('error', 'Invalid verification token.');
    }
    
}
