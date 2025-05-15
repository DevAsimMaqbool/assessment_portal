<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'answer_title',
        'answer_value',
        'created_by',
        'updated_by',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'answer_title', 'answer_value');
    }
}
