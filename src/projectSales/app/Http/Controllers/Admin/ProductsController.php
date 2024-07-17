<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\productModels;
use App\Models\categoryModels;
use App\Models\brandModels;
use App\Models\colorModels;
use App\Models\sizeModels;
use App\Models\productColorModels;
use App\Models\productSizeModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = productModels::with('category', 'brand')->orderBy('id', 'DESC')->get();
        return view('admins.products.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = categoryModels::all();
        $brand = brandModels::all();
        return view('admins.products.create', compact('category', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:products|max:255',
                'description' => 'required|max:255',
                'price_import' => 'required',
                'price_sell' => 'required',
                'category_id' => 'required',
                'brand_id' => 'required',
                'filee' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            ],
            [

                'title.unique' => 'Slug danh mục đã có ,xin điền slug khác',
                'title.required' => 'Tên danh mục phải có nhé',
                'price_import.required' => 'Yêu cầu nhập giá tiền nhập vào',
                'price_sell.required' => 'Yêu cầu nhập giá tiền bán ra',
                'description.required' => 'Mô tả danh mục phải có nhé',

            ]
        );
        $item = new productModels();
        $item->name = $data['name'];
        $item->price_sell = $data['price_sell'];
        $item->price_import = $data['price_import'];
        $item->category_id = $data['category_id'];
        $item->brand_id = $data['brand_id'];
        $item->description = $data['description'];
        //$item->thumnail = $data['thumnail'];
       
        $get_image = $request->filee;
        if ($get_image) {
            $path = 'images/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $item->thumnail = $new_image;
        }
        $item->save();
        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = categoryModels::all();
        $brand = brandModels::all();
        $item = productModels::find($id);
        return view('admins.products.edit', compact('category', 'brand', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'price_import' => 'required|numeric',
                'price_sell' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'filee' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Thêm quy định cho hình ảnh
            ],
            [
                'name.required' => 'Tên sản phẩm là bắt buộc',
                'description.required' => 'Mô tả sản phẩm là bắt buộc',
                'price_import.required' => 'Giá nhập vào là bắt buộc',
                'price_sell.required' => 'Giá bán là bắt buộc',
                'category_id.required' => 'Danh mục là bắt buộc',
                'brand_id.required' => 'Thương hiệu là bắt buộc',
                'filee.image' => 'Tệp tải lên phải là hình ảnh',
                'filee.mimes' => 'Hình ảnh phải có định dạng jpeg, png, hoặc jpg',
            ]
        );
        $item = productModels::find($id);
        $item->name = $data['name'];
        $item->description = $data['description'];
        $item->price_import = $data['price_import'];
        $item->price_sell = $data['price_sell'];
        $item->category_id = $data['category_id'];
        $item->brand_id = $data['brand_id'];
            
        if ($request->hasFile('filee')) {
            // Xóa hình ảnh cũ nếu có
            if ($item->thumnail) {
                // Xóa ảnh cũ khỏi thư mục public
                $oldImagePath = public_path('images/' . $item->thumnail);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Lưu hình ảnh mới
            $image = $request->file('filee');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/'), $imageName);
            $item->thumnail = $imageName;
        }
    
        $item->save();
    
        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        productModels::find($id)->delete();
        return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công.');
    }
    public function add_color_size($id)
    {
        $product = productModels::findOrFail($id);
    
        // Lấy tất cả kích cỡ và màu sắc
        $sizes = sizeModels::all();
        $colors = ColorModels::all();
        
        // Lấy tất cả màu sắc của sản phẩm và các kích cỡ liên quan
        $product_colors = productColorModels::with(['color', 'productSizes.size'])
            ->where('product_id', $id)
            ->get();
    
        // Truyền dữ liệu đến view
        return view('admins.products.create_size_color', compact('product', 'sizes', 'colors', 'product_colors'));
    }
    public function store_size_color(Request $request, $productId)
    {
        $request->validate([
            'color_id' => 'required|integer|exists:colors,id',
            'file' => 'required|image',
            'size_ids' => 'required|array',
            'size_ids.*' => 'required|integer|exists:sizes,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $product = productModels::findOrFail($productId);
        // Thêm màu sắc sản phẩm
        $productColor = new productColorModels();
        $productColor->color_id = $request->color_id;
        $productColor->product_id = $productId;

        // Xử lý hình ảnh
        $image = $request->file('file');
        if ($image) {
            $path = 'images/';
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $imageName);
            $productColor->img = $imageName;
        }
        $productColor->save();

        // Thêm kích cỡ và số lượng cho màu sắc mới
        $sizeIds = $request->size_ids;
        $quantities = $request->quantities;

        foreach ($sizeIds as $index => $sizeId) {
            $productSize = new productSizeModels();
            $productSize->product_color_id = $productColor->id;
            $productSize->size_id = $sizeId;
            $productSize->quantity = $quantities[$index];
            $productSize->save();
        }

        return redirect()->route('add-color-size', [$productId])->with('success', 'Đã thêm màu sắc và kích cỡ sản phẩm thành công.');
    }
    public function showdetail($productId)
    {
        // Tìm sản phẩm theo ID
        $product = ProductModels::findOrFail($productId);

        // Lấy danh sách màu sắc và kích cỡ của sản phẩm
        $productColors = ProductColorModels::with('product', 'color', 'productSizes.size')
            ->where('product_id', $productId)
            ->get();

        // Truyền biến tới view
        return view('admins.products.create_size_color', [
            'product' => $product,
            'productColors' => $productColors
        ]);
    }
    public function delete_size_color($id)
    {
        $productSize = productSizeModels::find($id);
    
    if ($productSize) {
        $productColorId = $productSize->product_color_id;
        $productSize->delete();
        
        // Kiểm tra nếu không còn kích thước nào liên quan đến màu sắc, thì xóa luôn màu sắc đó
        $remainingSizes = productSizeModels::where('product_color_id', $productColorId)->count();
        if ($remainingSizes == 0) {
            productColorModels::find($productColorId)->delete();
        }
    }

    return redirect()->back()->with('success', 'Xóa kích thước sản phẩm thành công.');

}
}
