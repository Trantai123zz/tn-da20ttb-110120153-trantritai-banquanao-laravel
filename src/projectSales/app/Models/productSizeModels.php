<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productSizeModels extends Model
{
    use HasFactory;
    protected $table = 'products_size';   
     protected $fillable = [
        'product_color_id', 'size_id', 'quantity'
    ];

    public function productColor()
    {
        return $this->belongsTo(productColorModels::class, 'product_color_id');
    }
    public function product()
    {
        return $this->belongsTo(productModels::class, 'product_id');
    }
    public function size()
    {
        return $this->belongsTo(sizeModels::class, 'size_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(oderdetailModels::class, 'product_size_id', 'id');
    }
    
}
