<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'severity',
        'is_resolved',
        'created_by',
        'updated_by',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Complaint belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
