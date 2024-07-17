<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productColorModels extends Model
{
    use HasFactory;
    protected $table = 'products_color';

    protected $fillable = [
        'img', 'color_id', 'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(productModels::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(colorModels::class, 'color_id');
    }


    public function productSizes()
    {
        return $this->hasMany(productSizeModels::class, 'product_color_id');
    }
    public function feedbacks()
    {
        return $this->hasMany(productfeedbackModels::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(SizeModels::class, 'products_size')
                    ->withPivot('quantity');
    }
}
