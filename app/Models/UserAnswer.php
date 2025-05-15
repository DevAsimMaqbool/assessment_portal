<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'answer',
        'user_id',
        'for_user_id',
        'survey_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answerOption()
    {
        return $this->belongsTo(QuestionAnswer::class, 'answer_title', 'answer_value');
    }
}
