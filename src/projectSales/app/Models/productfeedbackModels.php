<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productfeedbackModels extends Model
{
    use HasFactory;
    protected $table = 'product_feedback';

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'content',
    ];


    public function user()
    {
        return $this->belongsTo(usersModels::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(productModels::class, 'product_id');
    }
        /**
     * Tính trung bình số sao của sản phẩm.
     *
     * @return float
     */
    public function averageRating()
    {
        return $this->productFeedbacks()->avg('rating');
    }
}
