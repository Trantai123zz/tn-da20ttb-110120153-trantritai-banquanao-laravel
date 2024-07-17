<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\oderModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\categoryModels;
use App\Models\brandModels;

class ProfileController extends Controller
{
     /**
     * Show the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $categories = categoryModels::all();
        $brands = brandModels::all();
        $user = Auth::user();
        return view('auth.profileuser', compact('user','categories','brands'));
    }
    public function showw()
    {
        $categories = categoryModels::all();
        $brands = brandModels::all();
        $user = Auth::user();
        $orders = oderModels::where('user_id', $user->id)->orderByDesc('created_at')->get();

        return view('auth.profileuser', compact('user', 'orders','categories','brands'));
    }
    public function changePassword(Request $request)
    {
        // Validate input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Check if the current password matches
        $user = Auth::user();
        $userData = DB::table('users')->where('id', $user->id)->first();

        if (!Hash::check($request->current_password, $userData->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        // Update the password
        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi thành công');
    
    }
}
