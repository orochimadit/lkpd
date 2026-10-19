<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'total_questions',
        'correct_count',
        'answers_json',
    ];

    protected $casts = [
        'answers_json' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
