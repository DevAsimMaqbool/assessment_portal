<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
