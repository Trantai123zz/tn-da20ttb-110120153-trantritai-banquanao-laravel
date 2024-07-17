<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brandModels;
use App\Models\productModels;
use App\Models\categoryModels;
class brandController extends Controller
{public function index(Request $request)
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
    
    public function filterByBrand(Request $request, $brandId)
    {
        $query = productModels::where('brand_id', $brandId);

    // Sử dụng paginate để phân trang
    $products = $query->with('brand', 'productColors')->paginate(10);

    $categories = categoryModels::all();
    $brands = brandModels::whereHas('products')->get();
    $selectedBrand = brandModels::findOrFail($brandId);

    return view('client.welcome', compact('categories', 'brands', 'products', 'selectedBrand'));
    }


}
