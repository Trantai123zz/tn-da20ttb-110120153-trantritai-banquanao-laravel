<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class verifyuserModels extends Model
{
    use HasFactory;

    protected $table = 'user_verifies';
    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
        'email_verify',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
