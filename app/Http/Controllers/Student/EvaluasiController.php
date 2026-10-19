<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningProgress;
use App\Models\MotivationSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluasiController extends Controller
{
    protected array $surveyStatements = [
        1 => 'Saya merasa antusias dan senang ketika mempelajari materi iklan melalui website ini.',
        2 => 'Tampilan gambar, warna, dan video pada website ini membuat saya lebih mudah fokus belajar.',
        3 => 'Saya berusaha menyelesaikan semua latihan dan LKPD tanpa menunda-nunda.',
        4 => 'Ketika saya kesulitan menemukan ide iklan, saya berusaha mencari cara baru sampai berhasil.',
        5 => 'Saya ingin menghasilkan karya iklan yang unik dan membanggakan sekolah.',
        6 => 'Website ini membantu saya belajar secara mandiri sesuai kecepatan saya sendiri.',
        7 => 'Contoh-contoh produk lokal Pontianak (seperti Lidah Buaya) membuat belajar iklan jadi lebih menarik.',
        8 => 'Saya menjadi lebih kritis dan tidak mudah percaya begitu saja pada klaim berlebihan di iklan televisi.',
        9 => 'Saya merasa percaya diri untuk membuat karya iklan dengan ide saya sendiri tanpa meniru.',
        10 => 'Secara keseluruhan, saya merasa motivasi belajar saya meningkat setelah menggunakan e-modul ini.',
    ];

    public function index()
    {
        $user = Auth::user();
        $pretest = MotivationSurvey::where('user_id', $user->id)->where('survey_type', 'pretest')->first();
        $posttest = MotivationSurvey::where('user_id', $user->id)->where('survey_type', 'posttest')->first();

        return view('student.evaluasi.index', [
            'statements' => $this->surveyStatements,
            'pretest' => $pretest,
            'posttest' => $posttest,
        ]);
    }

    public function submitSurvey(Request $request)
    {
        $request->validate([
            'survey_type' => 'required|in:pretest,posttest',
            'answers' => 'required|array',
        ]);

        $user = Auth::user();
        $answers = $request->input('answers', []);
        $totalScore = array_sum($answers);
        $maxScore = count($this->surveyStatements) * 4; // 1-4 scale
        $percentage = round(($totalScore / $maxScore) * 100, 2);

        MotivationSurvey::updateOrCreate(
            ['user_id' => $user->id, 'survey_type' => $request->survey_type],
            [
                'answers_json' => $answers,
                'total_score' => $totalScore,
                'percentage' => $percentage,
            ]
        );

        if ($request->survey_type === 'posttest') {
            LearningProgress::updateOrCreate(
                ['user_id' => $user->id, 'module_slug' => 'evaluasi'],
                ['is_completed' => true, 'completed_at' => now()]
            );
        }

        return redirect()->route('student.evaluasi.index')->with('success', 'Terima kasih! Angket ' . ucfirst($request->survey_type) . ' motivasi belajar berhasil disimpan.');
    }
}
