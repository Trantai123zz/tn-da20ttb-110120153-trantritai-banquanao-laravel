<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\oderModels;
use App\Models\oderdetailModels;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\categoryModels;
use App\Models\brandModels;
use App\Models\sizeModels;
use App\Models\productSizeModels;

class OrderControllers extends Controller
{

    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện đặt hàng.');
        }
        $user = Auth::user();
        $cart = session()->get('cart', []);
        $totalMoney = $this->getCartTotal();
        $address = $user->address;
        $transportFee = 'Free Ship';

        return view('client.checkout', compact('user', 'cart', 'totalMoney', 'address', 'transportFee'));
    }
    public function showOrderDetails($id)
    {
        $categories = categoryModels::all();
        $brands = brandModels::whereHas('products')->get();
        // Lấy tất cả chi tiết đơn hàng cho đơn hàng có ID là $orderId
        $orderDetails = oderdetailModels::with(['size', 'product'])->where('order_id', $id)->get();

        return view('client.order_detail', compact('orderDetails','categories','brands'));
    
    }
    public function placeOrder(Request $request)
    {
        // Validate request data here if needed
        // Get current user
        $user = Auth::user();

        // Create new order
        $order = new oderModels();
        $order->user_id = $user->id;
        $order->total_money = $this->getCartTotal();
        $order->transport_fee = $request->input('transport_fee', 0);
        $order->order_status = 0;
        $order->note = $request->input('note', '');
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $order->updated_at = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $order->save();
        $cart = Session::get('cart');
        foreach ($cart as $id => $details) {
            $orderDetails = new oderdetailModels();

            $sizeName = sizeModels::find($details['product_size_id'])->name;

            $orderDetails->order_id = $order->id;
            $orderDetails->size = $sizeName;
            $orderDetails->product_size_id = $details['product_size_id'];
            $orderDetails->color = $details['color'];
            $orderDetails->unit_price = $details['price'];
            $orderDetails->product_id = $details['product_id'];
            $orderDetails->quantity = $details['quantity'];
            $orderDetails->save();
        }


        // Clear the cart after placing order
        Session::forget('cart');
        //send mail
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $title_mail = 'Xác nhận đơn hàng thành công. ' . $now;
        Mail::send('client.mail', [], function ($message) use ($title_mail) {
            $message->to(Auth::user()->email)->subject($title_mail); //send this mail with subject
            $message->from(Auth::user()->email, $title_mail); //send from this mail
        });
        // Redirect or return success message
        return redirect()->route('checkout.success')->with('success', 'Đặt hàng thành công!');
    }

    // Helper function to calculate total money from cart items
    private function getCartTotal()
    {
        $cart = session()->get('cart', []);
        // $total = 0;
        $totalMoney = 0;
        foreach ($cart as $item) {
            $totalMoney += $item['quantity'] * $item['price'];
        }

        return $totalMoney;
    }
    public function success()
    {
        return view('client.order_success');
    }
}
