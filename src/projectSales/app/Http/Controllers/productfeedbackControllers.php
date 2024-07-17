<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productfeedbackModels;
use App\Models\productModels;
use Illuminate\Support\Facades\Auth;
use App\Models\brandModels;
use App\Models\categoryModels;
use App\Models\oderModels;
use App\Models\productColorModels;

class productfeedbackControllers extends Controller
{
    /**
     * Hiển thị form đánh giá sản phẩm.
     *
     * @param  int  $productId
     * @return \Illuminate\View\View
     */
    public function create($productId)
    {
        $brands = brandModels::all();
        $categories = categoryModels::all();
        $product = productModels::findOrFail($productId);
        return view('client.product_details', compact('product', 'brands','categories'));
    }
    private function hasPurchasedProduct($userId, $productId)
    {
        return oderModels::where('user_id', $userId)
            ->whereHas('orderDetails', function($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->exists();
    }

    /**
     * Lưu đánh giá sản phẩm vào cơ sở dữ liệu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $productId)
    {
        
        try {
            $request->validate([
                'ratingStar' => 'required|integer|min:1|max:5',
                'content' => 'required|string|max:255',
            ]);

            // Lấy người dùng hiện tại
            $user = Auth::user();

            // Kiểm tra xem người dùng đã mua sản phẩm này chưa
            if (!$this->hasPurchasedProduct($user->id, $productId)) {
                return redirect()->back()->withErrors('Bạn phải mua sản phẩm này trước khi có thể đánh giá.');
            }

            // Tạo và lưu đánh giá
            $feedback = new productfeedbackModels();
            $feedback->user_id = $user->id;
            $feedback->product_id = $productId;
            $feedback->rating = $request->input('ratingStar');
            $feedback->content = $request->input('content');
            $feedback->save();

            $averageRating = productfeedbackModels::where('product_id', $productId)->avg('rating');

            // Điều hướng đến trang chi tiết sản phẩm với biến averageRating
            return redirect()->route('product.detail', $productId)
                ->with('success', 'Đánh giá của bạn đã được ghi nhận.')
                ->with('averageRating', $averageRating);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }
    public function showRatings($id)
    {
    $brands = brandModels::all();
    $categories = categoryModels::all();

    // Tìm sản phẩm theo ID
    $product = productModels::with('productColors.color')->findOrFail($id);

    // Lấy tất cả các đánh giá của sản phẩm
    $feedbacks = productfeedbackModels::where('product_id', $id)->orderBy('created_at', 'desc')->get();

    // Tính toán điểm trung bình của đánh giá
    $averageRating = $feedbacks->avg('rating');
    //$feedbacksByRating = $feedbacks->groupBy('rating');
    // Xử lý trường hợp không có đánh giá
    if (is_nan($averageRating)) {
        $averageRating = 0;
    }

    // Truyền dữ liệu vào view
    return view('client.product_details', compact('product', 'feedbacks', 'averageRating', 'brands', 'categories',));
    }

}
