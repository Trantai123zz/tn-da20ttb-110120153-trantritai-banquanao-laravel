<?php

namespace App\Http\Controllers;

use App\Models\productModels;
use Illuminate\Http\Request;
use App\Models\productColorModels;
use App\Models\sizeModels;
use Illuminate\Support\Facades\Session;

class cartControllers extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('client.productCart', compact('cart'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $product = productModels::findOrFail($productId);
        $color = productColorModels::with('color')->findOrFail($request->input('product_color_id'));
        $size = sizeModels::findOrFail($request->input('size_id'));

        $cart = session()->get('cart', []);

        $cartItemId = $productId . '-' . $request->input('product_color_id') . '-' . $request->input('size_id');

        if (isset($cart[$cartItemId])) {
            $cart[$cartItemId]['quantity'] += $quantity;
        } else {
            $cart[$cartItemId] = [
                "product_size_id" => $size->id,
                "product_id" => $productId,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price_sell,
                "photo" => $color->img,
                "size" => $size->name,
                "color" => $color->color->name
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}
