<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    protected array $topics = [
        'materi-1-pengertian' => [
            'id' => 1,
            'slug' => 'materi-1-pengertian',
            'title' => 'Topik 1: Pengertian & Tujuan Iklan',
            'prev_slug' => null,
            'next_slug' => 'materi-2-unsur',
        ],
        'materi-2-unsur' => [
            'id' => 2,
            'slug' => 'materi-2-unsur',
            'title' => 'Topik 2: Unsur & Struktur Iklan Efektif',
            'prev_slug' => 'materi-1-pengertian',
            'next_slug' => 'materi-3-fakta-opini',
        ],
        'materi-3-fakta-opini' => [
            'id' => 3,
            'slug' => 'materi-3-fakta-opini',
            'title' => 'Topik 3: Membedakan Fakta dan Opini dalam Iklan',
            'prev_slug' => 'materi-2-unsur',
            'next_slug' => 'materi-4-kearifan-lokal',
        ],
        'materi-4-kearifan-lokal' => [
            'id' => 4,
            'slug' => 'materi-4-kearifan-lokal',
            'title' => 'Topik 4: Iklan Kreatif Berbasis Kearifan Lokal Pontianak',
            'prev_slug' => 'materi-3-fakta-opini',
            'next_slug' => 'video-pembelajaran',
        ],
    ];

    public function index()
    {
        return redirect()->route('student.materi.show', 'materi-1-pengertian');
    }

    public function show(string $slug)
    {
        if (!isset($this->topics[$slug])) {
            return redirect()->route('student.materi.show', 'materi-1-pengertian');
        }

        $user = Auth::user();
        $topic = $this->topics[$slug];

        // Mark as completed automatically upon reading
        LearningProgress::updateOrCreate(
            ['user_id' => $user->id, 'module_slug' => $slug],
            ['is_completed' => true, 'completed_at' => now()]
        );

        return view('student.materi.show', compact('topic'));
    }
}
