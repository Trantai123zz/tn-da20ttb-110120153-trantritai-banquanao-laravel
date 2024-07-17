<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticalModels extends Model
{
    use HasFactory;
    protected $table = 'statistical';
    public $timestamps = false;
    protected $fillable = [
        'order_date',
        'sales',
        'profit',
        'quantity',
        'total_order'

    ];
}
