<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'question',
        'level',
        'type',
        'category_id',
        'status',
        'created_by',
        'updated_by',
    ];
    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class)
            ->orderBy('id', 'asc'); // Order answers ASC by answer_value
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
