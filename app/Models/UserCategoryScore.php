<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCategoryScore extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'attempt',
        'average_score'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'user_id', 'user_id')
            ->whereHas('question', function ($query) {
                $query->whereColumn('questions.category_id', 'user_category_scores.category_id');
            });
    }

}
