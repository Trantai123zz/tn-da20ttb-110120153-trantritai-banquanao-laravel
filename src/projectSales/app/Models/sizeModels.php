<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sizeModels extends Model
{
    use HasFactory;
    protected $table = 'sizes';   
    protected $fillable = ['name'];

    public function productSizes()
    {
        return $this->hasMany(productsizeModels::class, 'size_id');
    }
    public function productColors()
{
    return $this->belongsToMany(ProductColorModels::class, 'products_size')
                ->withPivot('quantity');
}

}

