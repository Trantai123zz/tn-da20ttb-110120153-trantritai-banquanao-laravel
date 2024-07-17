<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colorModels extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = 'colors'; 

    public function productColors()
    {
        return $this->hasMany(productColorModels::class, 'color_id');
    }
}
