<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CreativeProject;
use App\Models\LearningProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $project = CreativeProject::with('assessment')->where('user_id', $user->id)->first();

        $pontianakProducts = [
            'Es Lidah Buaya Segar Siantan' => 'Minuman khas Pontianak dari tanaman lidah buaya yang kaya khasiat dan menyegarkan.',
            'Kain Tenun Corak Insang' => 'Kain tenun tradisional khas Melayu Pontianak dengan motif gelombang insang ikan yang anggun.',
            'Kue Bingke Berendam Tradisional' => 'Kue manis lembut beraroma pandan yang menjadi ikon kuliner khas Pontianak.',
            'Pisang Goreng Selai Srikaya' => 'Camilan legendaris pisang nipah krispi berbalur selai srikaya Pontianak yang legit.',
            'Kopi Aming / Kopi Saring Tradisional' => 'Kopi aromatik khas warung kopi legendaris di Jalan Gajah Mada Pontianak.',
        ];

        return view('student.proyek.index', compact('project', 'pontianakProducts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_type' => 'required|string',
            'target_audience' => 'required|string|min:3',
            'angle_perspective' => 'required|string|min:3',
            'slogan' => 'required|string|min:5',
            'persuasive_text' => 'required|string|min:10',
            'visual_layout' => 'nullable|string',
        ]);

        $user = Auth::user();

        $project = CreativeProject::updateOrCreate(
            ['user_id' => $user->id],
            [
                'product_type' => $request->product_type,
                'target_audience' => $request->target_audience,
                'angle_perspective' => $request->angle_perspective,
                'slogan' => $request->slogan,
                'persuasive_text' => $request->persuasive_text,
                'visual_layout' => $request->visual_layout ?? 'Poster digital dengan ilustrasi produk dan ornamen khas Pontianak',
                'status' => 'submitted',
            ]
        );

        LearningProgress::updateOrCreate(
            ['user_id' => $user->id, 'module_slug' => 'proyek-kreatif'],
            ['is_completed' => true, 'completed_at' => now()]
        );

        return redirect()->route('student.proyek.index')->with('success', 'Luar biasa! Draf karya iklan kreatifmu berhasil dikumpulkan ke Guru untuk dinilai.');
    }
}
