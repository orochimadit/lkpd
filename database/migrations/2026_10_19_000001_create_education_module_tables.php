<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Data Siswa
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nisn')->unique();
            $table->string('class_name')->default('VI');
            $table->string('school_name')->default('SD Negeri 21 Pontianak Barat');
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->timestamps();
        });

        // 2. Modul Pembelajaran
        Schema::create('learning_modules', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category')->default('materi');
            $table->integer('order_num')->default(1);
            $table->timestamps();
        });

        // 3. Progres Belajar Siswa
        Schema::create('learning_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('module_slug');
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'module_slug']);
        });

        // 4. LKPD Digital Submissions
        Schema::create('lkpd_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('activity_name')->default('Aktivitas 1');
            $table->string('stimulus_title')->default('Es Lidah Buaya Khas Pontianak');
            $table->text('ad_purpose')->nullable();
            $table->text('product_advantage')->nullable();
            $table->text('fact_opinion_analysis')->nullable();
            $table->text('teacher_feedback')->nullable();
            $table->integer('score')->nullable();
            $table->string('status')->default('submitted');
            $table->timestamps();
        });

        // 5. Kuis Tantangan
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('score')->default(0);
            $table->integer('total_questions')->default(5);
            $table->integer('correct_count')->default(0);
            $table->json('answers_json')->nullable();
            $table->timestamps();
        });

        // 6. Proyek Iklan Kreatif (Y2)
        Schema::create('creative_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('product_type'); // e.g. Es Lidah Buaya Pontianak, Corak Insang
            $table->string('target_audience')->nullable();
            $table->string('angle_perspective')->nullable(); // Flexibility indicator
            $table->text('slogan'); // Originality indicator
            $table->text('persuasive_text'); // Elaboration indicator
            $table->string('visual_layout')->nullable();
            $table->string('poster_image')->nullable();
            $table->string('status')->default('submitted'); // 'draft', 'submitted'
            $table->timestamps();
        });

        // 7. Penilaian Rubrik Kreativitas (Guilford 4 Indikator)
        Schema::create('rubric_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creative_project_id')->constrained('creative_projects')->cascadeOnDelete();
            $table->foreignId('assessor_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('fluency_score')->default(1); // 1-4
            $table->tinyInteger('flexibility_score')->default(1); // 1-4
            $table->tinyInteger('originality_score')->default(1); // 1-4
            $table->tinyInteger('elaboration_score')->default(1); // 1-4
            $table->tinyInteger('total_score')->default(4); // 4-16
            $table->decimal('percentage', 5, 2)->default(25.00); // 25.00 - 100.00
            $table->string('category')->default('Kurang Kreatif'); // Sangat Kreatif, Kreatif, Cukup Kreatif, Kurang Kreatif
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 8. Angket Motivasi Belajar (Y1: Pretest & Posttest)
        Schema::create('motivation_surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('survey_type', ['pretest', 'posttest']);
            $table->json('answers_json'); // array of scores 1-4/5 for each motivation question
            $table->integer('total_score');
            $table->decimal('percentage', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motivation_surveys');
        Schema::dropIfExists('rubric_assessments');
        Schema::dropIfExists('creative_projects');
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('lkpd_submissions');
        Schema::dropIfExists('learning_progress');
        Schema::dropIfExists('learning_modules');
        Schema::dropIfExists('students');
    }
};
