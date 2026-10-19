<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\LearningModule;
use App\Models\LearningProgress;
use App\Models\LkpdSubmission;
use App\Models\QuizAttempt;
use App\Models\CreativeProject;
use App\Models\RubricAssessment;
use App\Models\MotivationSurvey;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Learning Modules
        $modules = [
            ['slug' => 'pendahuluan', 'title' => 'Pendahuluan & Petunjuk Belajar', 'category' => 'pendahuluan', 'order_num' => 1],
            ['slug' => 'materi-1-pengertian', 'title' => 'Topik 1: Pengertian & Tujuan Iklan', 'category' => 'materi', 'order_num' => 2],
            ['slug' => 'materi-2-unsur', 'title' => 'Topik 2: Unsur & Struktur Iklan', 'category' => 'materi', 'order_num' => 3],
            ['slug' => 'materi-3-fakta-opini', 'title' => 'Topik 3: Membedakan Fakta dan Opini dalam Iklan', 'category' => 'materi', 'order_num' => 4],
            ['slug' => 'materi-4-kearifan-lokal', 'title' => 'Topik 4: Iklan Kreatif Berbasis Kearifan Lokal Pontianak', 'category' => 'materi', 'order_num' => 5],
            ['slug' => 'video-pembelajaran', 'title' => 'Video Pembelajaran: Analisis Iklan Kontekstual', 'category' => 'video', 'order_num' => 6],
            ['slug' => 'lkpd-digital', 'title' => 'LKPD Digital: Menganalisis Iklan Minuman Khatulistiwa', 'category' => 'aktivitas', 'order_num' => 7],
            ['slug' => 'kuis-tantangan', 'title' => 'Kuis Tantangan Interaktif', 'category' => 'kuis', 'order_num' => 8],
            ['slug' => 'proyek-kreatif', 'title' => 'Studio Proyek: Rancang Iklan Produk Pontianak', 'category' => 'proyek', 'order_num' => 9],
            ['slug' => 'evaluasi', 'title' => 'Evaluasi Akhir & Refleksi Belajar', 'category' => 'evaluasi', 'order_num' => 10],
        ];

        foreach ($modules as $mod) {
            LearningModule::updateOrCreate(['slug' => $mod['slug']], $mod);
        }

        // 2. Seed Guru / Peneliti
        $guru = User::updateOrCreate(
            ['username' => 'guru'],
            [
                'name' => 'Fildzah Rahmawati, S.Pd',
                'email' => 'fildzah@guru.untan.ac.id',
                'role' => 'guru',
                'password' => Hash::make('password'),
            ]
        );

        // 3. Seed Sample Siswa Kelas VI
        $sampleStudents = [
            ['name' => 'Ahmad Pratama', 'username' => 'siswa1', 'nisn' => '0123456781', 'gender' => 'L'],
            ['name' => 'Siti Rahma', 'username' => 'siswa2', 'nisn' => '0123456782', 'gender' => 'P'],
            ['name' => 'Budi Setiawan', 'username' => 'siswa3', 'nisn' => '0123456783', 'gender' => 'L'],
        ];

        foreach ($sampleStudents as $sData) {
            $user = User::updateOrCreate(
                ['username' => $sData['username']],
                [
                    'name' => $sData['name'],
                    'email' => $sData['username'] . '@siswa.sdn21.sch.id',
                    'role' => 'siswa',
                    'password' => Hash::make('password'),
                ]
            );

            Student::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nisn' => $sData['nisn'],
                    'class_name' => 'VI C',
                    'school_name' => 'SD Negeri 21 Pontianak Barat',
                    'gender' => $sData['gender'],
                ]
            );

            // Seed initial progress for Ahmad Pratama (siswa1)
            if ($sData['username'] === 'siswa1') {
                LearningProgress::updateOrCreate(
                    ['user_id' => $user->id, 'module_slug' => 'pendahuluan'],
                    ['is_completed' => true, 'completed_at' => now()]
                );
                LearningProgress::updateOrCreate(
                    ['user_id' => $user->id, 'module_slug' => 'materi-1-pengertian'],
                    ['is_completed' => true, 'completed_at' => now()]
                );

                // Sample LKPD Submission
                LkpdSubmission::updateOrCreate(
                    ['user_id' => $user->id, 'activity_name' => 'Aktivitas 1'],
                    [
                        'stimulus_title' => 'Es Lidah Buaya Khas Pontianak',
                        'ad_purpose' => 'Mengajak masyarakat dan wisatawan untuk menikmati kesegaran minuman sehat khas Pontianak yang kaya serat dan vitamin.',
                        'product_advantage' => 'Menggunakan 100% daging lidah buaya asli Siantan, tanpa pemanis buatan, menyegarkan saat cuaca panas khatulistiwa.',
                        'fact_opinion_analysis' => 'Fakta: Mengandung vitamin C dan lidah buaya asli Siantan. Opini: Minuman paling nikmat dan segar tiada tanding.',
                        'status' => 'submitted',
                        'score' => 90,
                    ]
                );

                // Sample Creative Project
                $project = CreativeProject::updateOrCreate(
                    ['user_id' => $user->id, 'product_type' => 'Es Lidah Buaya Segar Siantan'],
                    [
                        'target_audience' => 'Anak-anak dan Keluarga Pecinta Minuman Sehat',
                        'angle_perspective' => 'Kesehatan Alami dari Bumi Khatulistiwa',
                        'slogan' => 'Dinginnya Nyata, Khasiat Alaminya Bikin Semangat Membara!',
                        'persuasive_text' => 'Rasakan sensasi kenyal lidah buaya asli Pontianak yang dipetik segar setiap pagi. Tanpa pengawet, pas dinikmati bersama teman!',
                        'visual_layout' => 'Ilustrasi gelas es lidah buaya dengan potongan jeruk nipis dan latar Tugu Khatulistiwa',
                        'status' => 'submitted',
                    ]
                );

                // Sample Assessment by Guru
                RubricAssessment::updateOrCreate(
                    ['creative_project_id' => $project->id],
                    [
                        'assessor_id' => $guru->id,
                        'fluency_score' => 4,
                        'flexibility_score' => 3,
                        'originality_score' => 4,
                        'elaboration_score' => 3,
                        'total_score' => 14,
                        'percentage' => 87.50,
                        'category' => 'Sangat Kreatif',
                        'notes' => 'Konsep iklan sangat orisinal, berhasil mengangkat produk khas Pontianak tanpa meniru iklan televisi!',
                    ]
                );
            }
        }
    }
}
