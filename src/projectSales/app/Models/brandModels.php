<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class brandModels extends Model
{
     use HasFactory, SoftDeletes;
     protected $table = 'brands'; 
     protected $fillable = ['name']; 
     public function products()
    {
        return $this->hasMany(productModels::class, 'brand_id');
    }
}
