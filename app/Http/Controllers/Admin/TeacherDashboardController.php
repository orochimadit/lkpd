<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\CreativeProject;
use App\Models\RubricAssessment;
use App\Models\LkpdSubmission;
use App\Models\QuizAttempt;
use App\Models\MotivationSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'siswa')
            ->with(['student', 'learningProgress', 'lkpdSubmissions', 'quizAttempts', 'creativeProjects.assessment', 'motivationSurveys'])
            ->get();

        $totalStudents = $students->count();
        $submittedProjects = CreativeProject::count();
        $assessedProjects = RubricAssessment::count();
        $quizAttemptsCount = QuizAttempt::count();
        $averageQuizScore = $quizAttemptsCount > 0 ? round(QuizAttempt::avg('score'), 1) : 0;

        return view('admin.dashboard', compact(
            'students',
            'totalStudents',
            'submittedProjects',
            'assessedProjects',
            'averageQuizScore'
        ));
    }

    public function showProject(int $projectId)
    {
        $project = CreativeProject::with(['user.student', 'assessment'])->findOrFail($projectId);

        return view('admin.assess', compact('project'));
    }

    public function saveAssessment(Request $request, int $projectId)
    {
        $request->validate([
            'fluency_score' => 'required|integer|min:1|max:4',
            'flexibility_score' => 'required|integer|min:1|max:4',
            'originality_score' => 'required|integer|min:1|max:4',
            'elaboration_score' => 'required|integer|min:1|max:4',
            'notes' => 'nullable|string',
        ]);

        $project = CreativeProject::findOrFail($projectId);
        $totalScore = $request->fluency_score + $request->flexibility_score + $request->originality_score + $request->elaboration_score;
        $categoryData = RubricAssessment::determineCategory($totalScore);

        RubricAssessment::updateOrCreate(
            ['creative_project_id' => $project->id],
            [
                'assessor_id' => Auth::id(),
                'fluency_score' => $request->fluency_score,
                'flexibility_score' => $request->flexibility_score,
                'originality_score' => $request->originality_score,
                'elaboration_score' => $request->elaboration_score,
                'total_score' => $totalScore,
                'percentage' => $categoryData['percentage'],
                'category' => $categoryData['category'],
                'notes' => $request->notes,
            ]
        );

        return redirect()->route('admin.dashboard')->with('success', 'Penilaian rubrik kreativitas berhasil disimpan (Total Skor: ' . $totalScore . '/16 - ' . $categoryData['category'] . ').');
    }
}
