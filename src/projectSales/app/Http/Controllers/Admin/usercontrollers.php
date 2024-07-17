<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usersModels;
class usercontrollers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = usersModels::with('addresses')->get();
        return view('admins.user.index', compact('users'));
    }
    public function destroy($id)
    {
        $user = usersModels::findOrFail($id);
        
        // Xóa người dùng và các bản ghi liên quan
        $user->delete();

        // Quay lại trang danh sách người dùng với thông báo thành công
        return redirect()->route('user.index')->with('success', 'Xóa người dùng thành công');
    }
    public function edit($id)
    {
        $user = usersModels::with('addresses')->findOrFail($id);
        return view('admins.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required|string|max:15',
            'apartment_number' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'province' => 'required|string|max:255',
        ]);

        $user = usersModels::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

        $user->addresses()->update([
            'apartment_number' => $request->apartment_number,
            'ward' => $request->ward,
            'district' => $request->district,
            'province' => $request->province,
        ]);

        return redirect()->route('user.edit', $id)->with('success', 'Customer updated successfully');
    }
}
