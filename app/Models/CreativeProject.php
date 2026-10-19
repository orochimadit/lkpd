<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreativeProject extends Model
{
    protected $fillable = [
        'user_id',
        'product_type',
        'target_audience',
        'angle_perspective',
        'slogan',
        'persuasive_text',
        'visual_layout',
        'poster_image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assessment()
    {
        return $this->hasOne(RubricAssessment::class, 'creative_project_id');
    }
}
