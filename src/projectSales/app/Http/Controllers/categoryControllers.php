<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoryModels;
use App\Models\brandModels;
use App\Models\productModels;
use Illuminate\Support\Facades\DB;
class categoryControllers extends Controller
{
    public function index(Request $request)
{
    $query = productModels::query();

    // Nếu có tham số lọc theo danh mục
    if ($request->has('category_id') && $request->category_id != '') {
        $query->where('category_id', $request->category_id);
    }

    // Nếu có tham số lọc theo thương hiệu
    if ($request->has('brand_id') && $request->brand_id != '') {
        $query->where('brand_id', $request->brand_id);
    }

    // Sử dụng paginate để phân trang
    $products = $query->with('brand', 'productColors')->paginate(10);

    $categories = categoryModels::all();
    $brands = brandModels::whereHas('products')->get();

    return view('client.welcome', compact('categories', 'brands', 'products'));
}

public function filterByCategory(Request $request, $categoryId)
{
    $query = productModels::where('category_id', $categoryId);

    // Nếu có tham số lọc theo thương hiệu
    if ($request->has('brand_id') && $request->brand_id != '') {
        $query->where('brand_id', $request->brand_id);
    }

    // Sử dụng paginate để phân trang
    $products = $query->with('brand', 'productColors')->paginate(10);

    $categories = categoryModels::all();
    $brands = brandModels::whereHas('products')->get();
    $selectedCategory = categoryModels::findOrFail($categoryId);

    return view('client.welcome', compact('categories', 'brands', 'products', 'selectedCategory'));
}
}
