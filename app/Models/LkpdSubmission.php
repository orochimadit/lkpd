<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LkpdSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'activity_name',
        'stimulus_title',
        'ad_purpose',
        'product_advantage',
        'fact_opinion_analysis',
        'teacher_feedback',
        'score',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
