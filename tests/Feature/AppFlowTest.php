<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Cerdas Beriklan');
    }

    public function test_student_can_access_dashboard_and_modules(): void
    {
        $student = User::where('role', 'siswa')->first();
        $this->actingAs($student);

        // Dashboard
        $response = $this->get(route('student.dashboard'));
        $response->assertStatus(200);
        $response->assertSee($student->name);

        // Materi
        $response = $this->get(route('student.materi.show', 'materi-1-pengertian'));
        $response->assertStatus(200);
        $response->assertSee('Pengertian & Tujuan');

        // LKPD
        $response = $this->get(route('student.lkpd.index'));
        $response->assertStatus(200);
        $response->assertSee('Aktivitas 1');

        // Kuis
        $response = $this->get(route('student.quiz.index'));
        $response->assertStatus(200);
        $response->assertSee('Kuis Tantangan');

        // Proyek Iklan
        $response = $this->get(route('student.proyek.index'));
        $response->assertStatus(200);
        $response->assertSee('Studio Rancang Iklan Kreatif');

        // Evaluasi
        $response = $this->get(route('student.evaluasi.index'));
        $response->assertStatus(200);
        $response->assertSee('Angket Motivasi');
    }

    public function test_teacher_can_access_dashboard_and_spss_export(): void
    {
        $guru = User::where('role', 'guru')->first();
        $this->actingAs($guru);

        // Teacher dashboard
        $response = $this->get(route('admin.dashboard'));
        $response->assertSee('Monitoring Pembelajaran', false);

        // SPSS Export
        $response = $this->get(route('admin.export.spss'));
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }
}
