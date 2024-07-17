<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productModels;
use App\Models\categoryModels;
use App\Models\productColorModels;
use App\Models\brandModels;
use App\Models\productfeedbackModels;
use Illuminate\Database\Eloquent\Collection;
class productControllers extends Controller
{
    public function index()
    {
        
        $brands = brandModels::all();
        $categories = categoryModels::all();
        $products = productModels::paginate(6);
        return view('client.welcome', compact('products', 'brands','categories',));
    }
    public function showdetail($id)
    {
        $brands = brandModels::all();
        $categories = categoryModels::all();
        $product = productModels::findOrFail($id);
        return view('client.product_details', compact('product', 'brands','categories'));
    }
    
    public function addToCart(Request $request, $id)
    {
        // Xử lý logic thêm vào giỏ hàng
        $color = $request->input('color');
        $size = $request->input('size');
        $quantity = $request->input('quantity');

        // Tìm sản phẩm
        $product = productModels::findOrFail($id);


        return redirect()->route('product.detail', ['id' => $id])->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }
    public function getSizes(Request $request)
    {
        $productColorId = $request->query('product_color_id');
        $productColor = productColorModels::findOrFail($productColorId);
        $sizes = $productColor->productSizes()->with('size')->get()->pluck('size');

        return response()->json($sizes);
    }
    public function redirectToHome()
    {
        return redirect()->route('home');
    }
    public function search(Request $request)
    {
        $brands = brandModels::all();
        $categories = categoryModels::all();
        $query = $request->input('query');

        // Tìm kiếm sản phẩm dựa trên tên hoặc mô tả
        $products = productModels::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        return view('client.search', compact('products', 'query','brands','categories'));
    }
    public function checkout()
    {
        // Your checkout logic here
        return view('client.checkout');
    }
    public function adminIndex()
    {
        $products = productModels::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price_import' => 'required|numeric',
            'price_sell' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|integer',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer'
        ]);

        $product = new productModels();
        $product->name = $request->input('name');
        $product->price_import = $request->input('price_import');
        $product->price_sell = $request->input('price_sell');
        $product->description = $request->input('description');
        $product->status = $request->input('status');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được thêm.');
    }

    public function edit($id)
    {
        $product = productModels::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price_import' => 'required|numeric',
            'price_sell' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|integer',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer'
        ]);

        $product = productModels::findOrFail($id);
        $product->name = $request->input('name');
        $product->price_import = $request->input('price_import');
        $product->price_sell = $request->input('price_sell');
        $product->description = $request->input('description');
        $product->status = $request->input('status');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được cập nhật.');
    }

    public function destroy($id)
    {
        $product = productModels::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được xóa.');
    }
   

}

