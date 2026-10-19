<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningProgress;
use App\Models\LkpdSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LkpdController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $submission = LkpdSubmission::where('user_id', $user->id)
            ->where('activity_name', 'Aktivitas 1')
            ->first();

        return view('student.lkpd.index', compact('submission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ad_purpose' => 'required|string|min:5',
            'product_advantage' => 'required|string|min:5',
            'fact_opinion_analysis' => 'required|string|min:5',
            'action' => 'required|in:draft,submit',
        ]);

        $user = Auth::user();

        $submission = LkpdSubmission::updateOrCreate(
            ['user_id' => $user->id, 'activity_name' => 'Aktivitas 1'],
            [
                'stimulus_title' => 'Es Lidah Buaya Khas Pontianak',
                'ad_purpose' => $request->ad_purpose,
                'product_advantage' => $request->product_advantage,
                'fact_opinion_analysis' => $request->fact_opinion_analysis,
                'status' => $request->action === 'submit' ? 'submitted' : 'draft',
            ]
        );

        if ($request->action === 'submit') {
            LearningProgress::updateOrCreate(
                ['user_id' => $user->id, 'module_slug' => 'lkpd-digital'],
                ['is_completed' => true, 'completed_at' => now()]
            );

            return redirect()->route('student.lkpd.index')->with('success', 'Hebat! LKPD Digital berhasil dikumpulkan ke Guru.');
        }

        return redirect()->route('student.lkpd.index')->with('info', 'Draf jawaban LKPD berhasil disimpan.');
    }
}
