<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;

class ExportController extends Controller
{
    public function exportSpss()
    {
        $students = User::where('role', 'siswa')
            ->with(['student', 'creativeProjects.assessment', 'motivationSurveys', 'quizAttempts'])
            ->get();

        $filename = "Rekap_Data_Penelitian_Tesis_SDN21_Pontianak_" . date('Y-m-d_His') . ".csv";

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () use ($students) {
            $file = fopen('php://output', 'w');
            // Write UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header Row
            fputcsv($file, [
                'No',
                'NISN',
                'Nama Siswa',
                'Jenis Kelamin',
                'Kelas',
                'Pretest Motivasi (Total)',
                'Posttest Motivasi (Total)',
                'N-Gain Motivasi',
                'Kategori N-Gain',
                'Kreativitas: Fluency (1-4)',
                'Kreativitas: Flexibility (1-4)',
                'Kreativitas: Originality (1-4)',
                'Kreativitas: Elaboration (1-4)',
                'Total Skor Kreativitas (4-16)',
                'Persentase Kreativitas (%)',
                'Kategori Kreativitas',
                'Skor Kuis (0-100)',
            ]);

            $no = 1;
            foreach ($students as $s) {
                $pre = $s->motivationSurveys->where('survey_type', 'pretest')->first();
                $post = $s->motivationSurveys->where('survey_type', 'posttest')->first();

                $preScore = $pre ? $pre->total_score : 0;
                $postScore = $post ? $post->total_score : 0;

                // N-Gain calculation: (Post - Pre) / (Max - Pre), Max = 40 (10 statements x 4)
                $maxPossible = 40;
                $nGain = '-';
                $nGainCategory = '-';
                if ($pre && $post && ($maxPossible - $preScore) > 0) {
                    $g = ($postScore - $preScore) / ($maxPossible - $preScore);
                    $nGain = round($g, 3);
                    if ($g >= 0.7) {
                        $nGainCategory = 'Tinggi';
                    } elseif ($g >= 0.3) {
                        $nGainCategory = 'Sedang';
                    } else {
                        $nGainCategory = 'Rendah';
                    }
                }

                $project = $s->creativeProjects->first();
                $assessment = $project ? $project->assessment : null;

                $latestQuiz = $s->quizAttempts->sortByDesc('created_at')->first();
                $quizScore = $latestQuiz ? $latestQuiz->score : '-';

                fputcsv($file, [
                    $no++,
                    $s->student ? $s->student->nisn : '-',
                    $s->name,
                    $s->student ? $s->student->gender : '-',
                    $s->student ? $s->student->class_name : 'VI C',
                    $preScore ?: '-',
                    $postScore ?: '-',
                    $nGain,
                    $nGainCategory,
                    $assessment ? $assessment->fluency_score : '-',
                    $assessment ? $assessment->flexibility_score : '-',
                    $assessment ? $assessment->originality_score : '-',
                    $assessment ? $assessment->elaboration_score : '-',
                    $assessment ? $assessment->total_score : '-',
                    $assessment ? $assessment->percentage . '%' : '-',
                    $assessment ? $assessment->category : 'Belum Dinilai',
                    $quizScore,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
