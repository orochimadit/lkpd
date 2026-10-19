<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningModule;
use App\Models\LearningProgress;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalModules = LearningModule::count();

        $completedCount = LearningProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();

        $progressPercent = $totalModules > 0 ? round(($completedCount / $totalModules) * 100) : 0;

        $completedSlugs = LearningProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->pluck('module_slug')
            ->toArray();

        return view('student.dashboard', compact('user', 'progressPercent', 'completedCount', 'totalModules', 'completedSlugs'));
    }
}
