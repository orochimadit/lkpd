@extends('layouts.app', ['title' => 'Evaluasi & Angket Motivasi'])

@section('content')
<main class="max-w-4xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">assignment_turned_in</span>
                <span>Instrumen Penelitian Tesis</span>
            </div>
            <h1 class="text-2xl font-extrabold text-primary font-headline">Angket Motivasi Belajar & Evaluasi</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">
                Isi angket di bawah ini dengan jujur sesuai pengalaman belajarmu menggunakan website E-Modul Iklan!
            </p>
        </div>

        <a href="{{ route('student.dashboard') }}" class="text-xs font-bold text-secondary flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-sm">home</span>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Status Cards: Pretest & Posttest -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="content-card p-5 border {{ $pretest ? 'border-green-300 bg-green-50/30' : 'border-outline-variant/30' }} rounded-2xl flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[11px] font-bold uppercase tracking-wider text-on-surface-variant">Tahap 1: Pengukuran Awal</span>
                <h3 class="font-bold text-primary text-base">Pretest Motivasi Belajar</h3>
                <p class="text-xs {{ $pretest ? 'text-green-700 font-semibold' : 'text-amber-700' }}">
                    {{ $pretest ? '✓ Sudah Diisi (Skor: ' . $pretest->total_score . '/40 - ' . $pretest->percentage . '%)' : 'Belum diisi' }}
                </p>
            </div>
            <span class="material-symbols-outlined text-3xl {{ $pretest ? 'text-green-600' : 'text-gray-300' }}">
                {{ $pretest ? 'check_circle' : 'pending' }}
            </span>
        </div>

        <div class="content-card p-5 border {{ $posttest ? 'border-green-300 bg-green-50/30' : 'border-outline-variant/30' }} rounded-2xl flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[11px] font-bold uppercase tracking-wider text-on-surface-variant">Tahap 2: Pengukuran Akhir</span>
                <h3 class="font-bold text-primary text-base">Posttest Motivasi Belajar</h3>
                <p class="text-xs {{ $posttest ? 'text-green-700 font-semibold' : 'text-amber-700' }}">
                    {{ $posttest ? '✓ Sudah Diisi (Skor: ' . $posttest->total_score . '/40 - ' . $posttest->percentage . '%)' : 'Belum diisi' }}
                </p>
            </div>
            <span class="material-symbols-outlined text-3xl {{ $posttest ? 'text-green-600' : 'text-gray-300' }}">
                {{ $posttest ? 'check_circle' : 'pending' }}
            </span>
        </div>
    </div>

    <!-- Survey Form Section -->
    <div class="content-card p-6 md:p-8 border border-outline-variant/30 space-y-6">
        
        <form action="{{ route('student.evaluasi.survey') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Survey Type Selector -->
            <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/40 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <span class="text-xs font-bold text-primary uppercase tracking-wider">Pilih Jenis Pengukuran Angket:</span>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 text-xs font-bold cursor-pointer text-primary">
                        <input type="radio" name="survey_type" value="pretest" class="text-secondary" {{ (!$pretest || old('survey_type') === 'pretest') ? 'checked' : '' }}>
                        <span>Pretest (Sebelum Pembelajaran)</span>
                    </label>
                    <label class="flex items-center gap-2 text-xs font-bold cursor-pointer text-primary">
                        <input type="radio" name="survey_type" value="posttest" class="text-secondary" {{ ($pretest && !$posttest) || old('survey_type') === 'posttest' ? 'checked' : '' }}>
                        <span>Posttest (Sesudah Pembelajaran)</span>
                    </label>
                </div>
            </div>

            <!-- Likert Statements -->
            <div class="space-y-4">
                <div class="hidden md:grid grid-cols-12 text-xs font-bold text-on-surface-variant px-4 pb-2 border-b border-outline-variant/30">
                    <span class="col-span-8">Pernyataan Indikator Motivasi Belajar</span>
                    <span class="col-span-1 text-center">STS (1)</span>
                    <span class="col-span-1 text-center">TS (2)</span>
                    <span class="col-span-1 text-center">S (3)</span>
                    <span class="col-span-1 text-center">SS (4)</span>
                </div>

                @foreach($statements as $num => $stmt)
                    <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/20 flex flex-col md:grid md:grid-cols-12 items-center gap-3 text-xs md:text-sm">
                        <div class="w-full md:col-span-8 flex items-start gap-2.5">
                            <span class="w-6 h-6 rounded-full bg-secondary/10 text-secondary font-bold text-xs flex items-center justify-center shrink-0">
                                {{ $num }}
                            </span>
                            <span class="text-on-surface leading-relaxed">{{ $stmt }}</span>
                        </div>

                        <!-- 4 Likert Radios -->
                        <div class="w-full md:col-span-4 grid grid-cols-4 gap-2 text-center pt-2 md:pt-0">
                            <label class="flex flex-col items-center cursor-pointer p-1 rounded-lg hover:bg-white">
                                <input type="radio" name="answers[{{ $num }}]" value="1" required class="text-secondary focus:ring-secondary w-4 h-4">
                                <span class="text-[10px] text-on-surface-variant md:hidden mt-1">STS</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer p-1 rounded-lg hover:bg-white">
                                <input type="radio" name="answers[{{ $num }}]" value="2" required class="text-secondary focus:ring-secondary w-4 h-4">
                                <span class="text-[10px] text-on-surface-variant md:hidden mt-1">TS</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer p-1 rounded-lg hover:bg-white">
                                <input type="radio" name="answers[{{ $num }}]" value="3" required class="text-secondary focus:ring-secondary w-4 h-4">
                                <span class="text-[10px] text-on-surface-variant md:hidden mt-1">S</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer p-1 rounded-lg hover:bg-white">
                                <input type="radio" name="answers[{{ $num }}]" value="4" required class="text-secondary focus:ring-secondary w-4 h-4" checked>
                                <span class="text-[10px] text-on-surface-variant md:hidden mt-1">SS</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="pt-4 flex justify-between items-center border-t border-outline-variant/20">
                <a href="{{ route('student.dashboard') }}" class="px-5 py-3 border-2 border-primary text-primary font-bold text-xs rounded-xl hover:bg-primary/5 transition-all">
                    &larr; Beranda
                </a>
                <button type="submit" class="px-8 py-3.5 bg-secondary text-white font-bold text-xs md:text-sm rounded-xl nav-btn-shadow hover:brightness-105 active:scale-[0.99] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">check_circle</span>
                    <span>Simpan Angket Motivasi</span>
                </button>
            </div>
        </form>

    </div>

</main>
@endsection
