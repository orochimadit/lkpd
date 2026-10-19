<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class MotivationAnalysisController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'siswa')
            ->with(['student', 'motivationSurveys'])
            ->get();

        $maxScore = 40; // 10 butir x 4 skala
        $gains = [];
        $totalGain = 0;
        $validGainCount = 0;

        foreach ($students as $s) {
            $pre = $s->motivationSurveys->where('survey_type', 'pretest')->first();
            $post = $s->motivationSurveys->where('survey_type', 'posttest')->first();

            $preScore = $pre ? $pre->total_score : null;
            $postScore = $post ? $post->total_score : null;

            $nGain = null;
            $category = 'Belum Lengkap';

            if ($preScore !== null && $postScore !== null && ($maxScore - $preScore) > 0) {
                $g = ($postScore - $preScore) / ($maxScore - $preScore);
                $nGain = round($g, 3);
                $totalGain += $g;
                $validGainCount++;

                if ($g >= 0.7) {
                    $category = 'Tinggi';
                } elseif ($g >= 0.3) {
                    $category = 'Sedang';
                } else {
                    $category = 'Rendah';
                }
            }

            $gains[$s->id] = [
                'pre' => $preScore,
                'post' => $postScore,
                'ngain' => $nGain,
                'category' => $category,
            ];
        }

        $averageNGain = $validGainCount > 0 ? round($totalGain / $validGainCount, 3) : 0;
        $averageCategory = '-';
        if ($averageNGain >= 0.7) {
            $averageCategory = 'Tinggi (Efektivitas Tinggi)';
        } elseif ($averageNGain >= 0.3) {
            $averageCategory = 'Sedang (Efektivitas Cukup Efektif)';
        } elseif ($validGainCount > 0) {
            $averageCategory = 'Rendah (Kurang Efektif)';
        }

        return view('admin.motivasi.index', compact('students', 'gains', 'averageNGain', 'averageCategory'));
    }
}
