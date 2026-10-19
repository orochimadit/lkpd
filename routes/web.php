<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\MateriController;
use App\Http\Controllers\Student\VideoController;
use App\Http\Controllers\Student\LkpdController;
use App\Http\Controllers\Student\QuizController;
use App\Http\Controllers\Student\ProjectController;
use App\Http\Controllers\Student\EvaluasiController;
use App\Http\Controllers\Admin\TeacherDashboardController;
use App\Http\Controllers\Admin\ExportController;

// Landing / Redirect
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isGuru()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('student.dashboard');
    }
    return redirect()->route('login');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/quick-login/{role}', [AuthController::class, 'quickLogin'])->name('quick-login');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Student Portal
    Route::prefix('belajar')->name('student.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
        Route::get('/materi/{slug}', [MateriController::class, 'show'])->name('materi.show');

        Route::get('/video', [VideoController::class, 'index'])->name('video.index');

        Route::get('/lkpd', [LkpdController::class, 'index'])->name('lkpd.index');
        Route::post('/lkpd', [LkpdController::class, 'store'])->name('lkpd.store');

        Route::get('/kuis', [QuizController::class, 'index'])->name('quiz.index');
        Route::post('/kuis', [QuizController::class, 'submit'])->name('quiz.submit');

        Route::get('/proyek', [ProjectController::class, 'index'])->name('proyek.index');
        Route::post('/proyek', [ProjectController::class, 'store'])->name('proyek.store');

        Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi.index');
        Route::post('/evaluasi/survei', [EvaluasiController::class, 'submitSurvey'])->name('evaluasi.survey');
    });

    // Teacher / Researcher Portal
    Route::prefix('guru')->name('admin.')->group(function () {
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
        Route::get('/proyek/{projectId}', [TeacherDashboardController::class, 'showProject'])->name('project.show');
        Route::post('/proyek/{projectId}/nilai', [TeacherDashboardController::class, 'saveAssessment'])->name('project.assess');
        Route::get('/export-spss', [ExportController::class, 'exportSpss'])->name('export.spss');
    });
});
