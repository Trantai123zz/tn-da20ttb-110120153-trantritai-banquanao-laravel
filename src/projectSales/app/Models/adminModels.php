<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class adminModels extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins';
    
    protected $fillable = [
        'username', 'password', 'email'
    ];
    protected $guarded = [];

    public function getAuthIdentifierName()
    {
        return 'id'; // Tên cột xác định người dùng
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
