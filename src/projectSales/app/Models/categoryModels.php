<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoryModels extends Model
{
    protected $table = 'categories';

    // Các cột có thể được gán hàng loạt
    protected $fillable = ['name', 'parent_id', 'slug'];

    // Nếu bạn không sử dụng soft deletes, bỏ qua dòng dưới
    protected $dates = ['deleted_at']; // Cột 'deleted_at' nếu dùng soft deletes

    // Định nghĩa mối quan hệ với danh mục cha nếu có
    public function parent()
    {
        return $this->belongsTo(categoryModels::class, 'parent_id');
    }

    // Định nghĩa mối quan hệ với danh mục con nếu có
    public function children()
    {
        return $this->hasMany(categoryModels::class, 'parent_id');
    }
   
}