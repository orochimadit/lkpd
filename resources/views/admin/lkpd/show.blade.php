@extends('layouts.app', ['title' => 'Pemeriksaan LKPD'])

@section('content')
<main class="max-w-6xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Header -->
    <div class="flex items-center justify-between border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-green-700 uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">fact_check</span>
                <span>Pemeriksaan Jawaban LKPD Digital Siswa</span>
            </div>
            <h1 class="text-2xl font-extrabold text-primary font-headline">Lembar Kerja: {{ $submission->user->name }}</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">
                NISN: {{ $submission->user->student ? $submission->user->student->nisn : '-' }} • Kelas VI C SDN 21 Pontianak Barat
            </p>
        </div>

        <a href="{{ route('admin.lkpd.index') }}" class="text-xs font-bold text-primary flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span>Kembali ke Daftar LKPD</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Side: Student Answers -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Answer 1 -->
            <div class="content-card p-6 border border-outline-variant/30 rounded-2xl space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">1</span>
                    <h3 class="text-sm font-bold text-primary font-headline">Jawaban: Analisis Tujuan Iklan</h3>
                </div>
                <div class="p-4 bg-surface-container-low rounded-xl text-xs md:text-sm text-on-surface leading-relaxed">
                    {{ $submission->ad_purpose ?: '(Belum dijawab)' }}
                </div>
            </div>

            <!-- Answer 2 -->
            <div class="content-card p-6 border border-outline-variant/30 rounded-2xl space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">2</span>
                    <h3 class="text-sm font-bold text-primary font-headline">Jawaban: Identifikasi Keunggulan Produk</h3>
                </div>
                <div class="p-4 bg-surface-container-low rounded-xl text-xs md:text-sm text-on-surface leading-relaxed">
                    {{ $submission->product_advantage ?: '(Belum dijawab)' }}
                </div>
            </div>

            <!-- Answer 3 -->
            <div class="content-card p-6 border border-outline-variant/30 rounded-2xl space-y-2">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">3</span>
                    <h3 class="text-sm font-bold text-primary font-headline">Jawaban: Analisis Kritis (Fakta vs Opini)</h3>
                </div>
                <div class="p-4 bg-surface-container-low rounded-xl text-xs md:text-sm text-on-surface leading-relaxed whitespace-pre-line">
                    {{ $submission->fact_opinion_analysis ?: '(Belum dijawab)' }}
                </div>
            </div>

        </div>

        <!-- Right Side: Grading & Feedback Form -->
        <div class="lg:col-span-5 sticky top-20 content-card p-6 md:p-8 border border-outline-variant/30 rounded-2xl shadow-sm space-y-6">
            <h3 class="text-base font-bold text-primary font-headline border-b border-outline-variant/30 pb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">rate_review</span>
                <span>Form Penilaian Guru</span>
            </h3>

            <form action="{{ route('admin.lkpd.grade', $submission->id) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="score" class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">
                        Nilai Angka LKPD (Skala 0 - 100):
                    </label>
                    <input type="number" name="score" id="score" min="0" max="100" required 
                           value="{{ old('score', $submission->score ?? 90) }}"
                           class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-lg font-bold text-secondary focus:outline-none focus:border-secondary">
                </div>

                <div>
                    <label for="teacher_feedback" class="block text-xs font-bold text-primary uppercase tracking-wider mb-1">
                        Catatan & Umpan Balik untuk Siswa:
                    </label>
                    <textarea name="teacher_feedback" id="teacher_feedback" rows="4"
                              class="w-full p-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary leading-relaxed"
                              placeholder="Berikan umpan balik atau apresiasi terhadap hasil analisis siswa...">{{ old('teacher_feedback', $submission->teacher_feedback ?? 'Analisis fakta dan opini sudah sangat tepat. Siswa mampu membedakan data objektif dengan klaim promosi.') }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 bg-secondary text-white font-bold rounded-xl text-xs md:text-sm nav-btn-shadow hover:brightness-105 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-base">check_circle</span>
                        <span>Simpan Nilai & Umpan Balik</span>
                    </button>
                </div>
            </form>
        </div>

    </div>

</main>
@endsection
