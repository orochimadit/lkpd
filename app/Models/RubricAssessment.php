<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RubricAssessment extends Model
{
    protected $fillable = [
        'creative_project_id',
        'assessor_id',
        'fluency_score',
        'flexibility_score',
        'originality_score',
        'elaboration_score',
        'total_score',
        'percentage',
        'category',
        'notes',
    ];

    public function project()
    {
        return $this->belongsTo(CreativeProject::class, 'creative_project_id');
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }

    /**
     * Helper to calculate total, percentage and category
     */
    public static function determineCategory(int $totalScore): array
    {
        $percentage = round(($totalScore / 16) * 100, 2);

        if ($totalScore >= 13) {
            $category = 'Sangat Kreatif';
        } elseif ($totalScore >= 10) {
            $category = 'Kreatif';
        } elseif ($totalScore >= 7) {
            $category = 'Cukup Kreatif';
        } else {
            $category = 'Kurang Kreatif';
        }

        return [
            'percentage' => $percentage,
            'category' => $category,
        ];
    }
}
