<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oderdetailModels extends Model
{
    use SoftDeletes;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id', 'product_id', 'size', 'product_size_id', 'color', 'unit_price', 'quantity'
    ];

    public function size()
    {
        return $this->belongsTo(sizeModels::class, 'size', 'id');
    }

    // Quan hệ với bảng products_size
    public function productSize()
    {
        return $this->belongsTo(productSizeModels::class, 'product_size_id');
    }

    // Quan hệ với bảng products
    public function product()
    {
        return $this->belongsTo(productModels::class, 'product_id');
    }
    public function orders()
    {
        return $this->belongsTo(oderModels::class);
    }

}
