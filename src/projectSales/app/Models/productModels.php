<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class productModels extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price_import',
        'price_sell',
        'description',
        'status',
        'category_id',
        'brand_id',
        'thumnail',
    ];
    public function productColors()
    {
        return $this->hasMany(productColorModels::class, 'product_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OderdetailModels::class, 'product_id', 'id');
    }
    public function sizes()
    {
        return $this->hasMany(productSizeModels::class, 'product_id');
    }
    public function feedbacks()
    {
        return $this->hasMany(productfeedbackModels::class, 'product_id');
    }
    public function categories()
    {
        return $this->belongsToMany(categoryModels::class);
    }
    public function category()
    {
        return $this->belongsTo(categoryModels::class);
    }
    public function brand()
    {
        return $this->belongsTo(brandModels::class);
    }
    
}
