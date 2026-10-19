<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningProgress;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        LearningProgress::updateOrCreate(
            ['user_id' => $user->id, 'module_slug' => 'video-pembelajaran'],
            ['is_completed' => true, 'completed_at' => now()]
        );

        return view('student.video.index');
    }
}
