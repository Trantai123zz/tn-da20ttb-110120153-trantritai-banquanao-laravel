<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\oderModels;
use App\Models\oderdetailModels;
use App\Models\productModels;
use App\Models\StatisticalModels;
use Carbon\Carbon;
use App\Models\productSizeModels;
//use Mail;
use Illuminate\Support\Facades\Mail;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function test_mail()
    {

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $title_mail = 'Xác nhận đơn hàng thành công. ' . $now;
        Mail::send('client.mail', [], function ($message) use ($title_mail) {
            $message->to('themenshop111@gmail.com')->subject($title_mail); //send this mail with subject
            $message->from('themenshop111@gmail.com', $title_mail); //send from this mail
        });
    }
    public function index()
    {
        $orders = oderModels::with('user')->orderBy('id', 'DESC')->get();
        return view('admins.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = oderModels::with('user')->find($id);
        $order_detail = oderdetailModels::with('product')->where('order_id', $id)->get();
        return view('admins.orders.show', compact('order_detail', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function update_order($id)
    {
        $order = oderModels::find($id);
        $order->order_status = 1;
        $order->save();
        //update statistical
        $order_product_id = oderdetailModels::with('product')->where('order_id', $id)->get();
        $statistic = StatisticalModels::where('order_date', $order->created_at)->first();
        if ($order->order_status == 1) {
            //them
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;


            
            foreach ($order_product_id as $key => $order_de) {

                $product = productModels::find($order_de->product_id);
                $order_detail = oderdetailModels::where('product_id', $product->id)->where('order_id', $id)->first();

                $product_quantity = $order_detail->quantity;
                $product_sold = $product->product_sold;
                //them
                $product_price = $order_detail->unit_price;
                $product_price_import = $product->price_import;
             

                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        ;
                $pro_remain = $product_quantity - $order_detail->quantity;
                $product->quantity = $pro_remain;
                $product->product_sold = $product_sold + $order_detail->quantity;
                $product->save();
                //update doanh thu
                $quantity += $order_detail->quantity;
                $total_order += 1;
                $sales += $product_price * $order_detail->quantity;
                $profit += $sales - ($product_price_import * $order_detail->quantity);
            }
            
            
            //update doanh so db
            if ($statistic != '') {
                $statistic_update = StatisticalModels::where('order_date', $order->created_at)->first();
                $statistic_update->sales = $statistic_update->sales + $sales;
                $statistic_update->profit =  $statistic_update->profit + $profit;
                $statistic_update->quantity =  $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + 1;
                $statistic_update->save();
            } else {

                $statistic_new = new StatisticalModels();
                $statistic_new->order_date = $order->created_at;
                $statistic_new->sales = $sales;
                $statistic_new->profit =  $profit;
                $statistic_new->quantity =  $quantity;
                $statistic_new->total_order = 1;
                $statistic_new->save();
            }

            return redirect()->route('order.index')->with('success', 'Cập nhật đơn hàng thành công!');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $del_order = oderModels::find($id)->delete();
        if ($del_order) {
            oderdetailModels::whereIn('order_id', [$id])->delete();
        }
        return redirect()->back()->with('success', 'Xóa đơn hàng thành công!');
    }
}
