<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class addressModels extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'addresses';
    protected $fillable = [
        'user_id', 'province', 'district', 'ward', 'apartment_number',
    ];

    public function user()
    {
        return $this->belongsTo(usersModels::class);
    }
}
