<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oderModels extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'total_money',
        'transport_fee',
        'note',
        'order_status',
        'payment_status',
    ];

    // Định nghĩa mối quan hệ với các chi 

    public function user()
    {
        return $this->belongsTo(usersModels::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(oderdetailModels::class, 'order_id');
    }
    public function address()
    {
        return $this->belongsTo(addressModels::class, 'address_id');
    }
    public function productSize()
    {
        return $this->belongsTo(productSizeModels::class, 'product_size_id');
    }
}
