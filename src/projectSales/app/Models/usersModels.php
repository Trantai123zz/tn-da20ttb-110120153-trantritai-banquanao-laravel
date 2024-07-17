<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class usersModels extends Model
{
    use HasFactory;
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            // Xóa các địa chỉ liên quan
            $user->addresses()->delete();

            // Xóa các phản hồi sản phẩm liên quan
            $user->productFeedbacks()->delete();

            // Xóa các chi tiết đơn hàng liên quan
            foreach ($user->orders as $order) {
                $order->orderDetails()->delete();
                $order->delete();
            }
        });
    }



    public function productFeedbacks()
    {
        return $this->hasMany(productfeedbackModels::class, 'user_id');
    }

   
    public function address()
    {
        return $this->hasOne(addressModels::class);
    }
    public function orders()
    {
        return $this->hasMany(oderModels::class, 'user_id');
    }
    public function verifyUser()
    {
        return $this->hasOne(verifyuserModels::class);
    }
    public function addresses()
    {
        return $this->hasMany(addressModels::class, 'user_id');
    }
}
