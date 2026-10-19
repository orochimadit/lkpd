<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotivationSurvey extends Model
{
    protected $fillable = [
        'user_id',
        'survey_type',
        'answers_json',
        'total_score',
        'percentage',
    ];

    protected $casts = [
        'answers_json' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
