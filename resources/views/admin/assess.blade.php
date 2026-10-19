@extends('layouts.app', ['title' => 'Penilaian Rubrik Kreativitas'])

@section('content')
<main class="max-w-6xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Header -->
    <div class="flex items-center justify-between border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-purple-700 uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">rate_review</span>
                <span>Instrumen Penilaian Variabel Y2 (Kreativitas Guilford)</span>
            </div>
            <h1 class="text-2xl font-extrabold text-primary font-headline">Rubrik Penilaian Karya Iklan Siswa</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">
                Siswa: <strong>{{ $project->user->name }}</strong> (NISN: {{ $project->user->student ? $project->user->student->nisn : '-' }}) • Kelas VI C SDN 21 Pontianak Barat
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-primary flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Side: Student's Ad Work (Poster Preview & Detail) -->
        <div class="lg:col-span-5 sticky top-20 space-y-4">
            <div class="content-card p-5 border border-outline-variant/30 rounded-2xl shadow-sm space-y-4">
                <span class="text-xs font-bold text-primary uppercase tracking-wider block">Karya Iklan yang Dibuat Siswa:</span>

                <!-- Poster Box -->
                <div class="rounded-xl overflow-hidden bg-gradient-to-br from-[#021541] via-[#003882] to-[#0060ac] text-white p-6 text-center space-y-3 shadow-md">
                    <span class="inline-block bg-white/90 text-primary px-3 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest">
                        PRODUK KHAS PONTIANAK
                    </span>
                    <h3 class="text-xl font-black font-headline text-yellow-300">
                        "{{ $project->slogan }}"
                    </h3>
                    <p class="text-xs text-secondary-fixed font-bold">{{ $project->product_type }}</p>
                    <p class="text-[11px] text-gray-200 leading-relaxed italic bg-black/20 p-3 rounded-lg">
                        {{ $project->persuasive_text }}
                    </p>
                    <p class="text-[10px] text-gray-300">
                        <strong>Visual:</strong> {{ $project->visual_layout }}
                    </p>
                </div>

                <div class="text-xs text-on-surface-variant space-y-1.5 pt-2 border-t border-outline-variant/20">
                    <p><strong>Sudut Pandang (Flexibility):</strong> {{ $project->angle_perspective }}</p>
                    <p><strong>Sasaran Pembeli:</strong> {{ $project->target_audience }}</p>
                    <p><strong>Waktu Dikumpulkan:</strong> {{ $project->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Guilford Rubric Scoring Form -->
        <div class="lg:col-span-7 content-card p-6 md:p-8 border border-outline-variant/30 rounded-2xl shadow-sm space-y-6">
            <form action="{{ route('admin.project.assess', $project->id) }}" method="POST" class="space-y-6" id="rubricForm">
                @csrf

                <!-- Live Score Counter Banner -->
                <div class="p-4 bg-purple-50 border border-purple-200 rounded-xl flex items-center justify-between">
                    <div>
                        <span class="text-xs text-purple-900 font-bold uppercase tracking-wider block">Total Skor Kreativitas:</span>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-2xl font-black text-purple-900 font-headline" id="totalScoreText">
                                {{ $project->assessment ? $project->assessment->total_score : 14 }}
                            </span>
                            <span class="text-xs text-purple-800">/ 16 (<span id="percentageText">{{ $project->assessment ? $project->assessment->percentage : 87.5 }}</span>%)</span>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-purple-600 text-white rounded-full text-xs font-bold shadow-xs" id="categoryBadge">
                        {{ $project->assessment ? $project->assessment->category : 'Sangat Kreatif' }}
                    </span>
                </div>

                <!-- Indikator 1: Fluency -->
                <div class="space-y-2 border-b border-outline-variant/20 pb-4">
                    <div class="flex items-center justify-between">
                        <label class="text-xs md:text-sm font-bold text-primary flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-primary text-white text-xs flex items-center justify-center font-bold">1</span>
                            <span>Kelancaran (Fluency) - Kemampuan menghasilkan gagasan</span>
                        </label>
                    </div>
                    <div class="grid grid-cols-4 gap-2 pt-1 text-xs">
                        @foreach([
                            1 => '1: Belum mampu memunculkan variasi ide produk.',
                            2 => '2: Menghasilkan 1 ide produk kearifan lokal.',
                            3 => '3: Mengembangkan 2-3 ide gagasan produk dengan tepat.',
                            4 => '4: Sangat lancar menghasilkan ragam gagasan produk lokal.'
                        ] as $val => $desc)
                            <label class="p-2.5 rounded-xl border border-outline-variant/40 hover:bg-gray-50 cursor-pointer flex flex-col justify-between text-[11px] leading-tight">
                                <input type="radio" name="fluency_score" value="{{ $val }}" class="rubric-input text-secondary"
                                    {{ old('fluency_score', $project->assessment->fluency_score ?? 4) == $val ? 'checked' : '' }}>
                                <span class="mt-1 text-on-surface">{{ $desc }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Indikator 2: Flexibility -->
                <div class="space-y-2 border-b border-outline-variant/20 pb-4">
                    <div class="flex items-center justify-between">
                        <label class="text-xs md:text-sm font-bold text-primary flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-primary text-white text-xs flex items-center justify-center font-bold">2</span>
                            <span>Keluwesan (Flexibility) - Variasi sudut pandang promosi</span>
                        </label>
                    </div>
                    <div class="grid grid-cols-4 gap-2 pt-1 text-xs">
                        @foreach([
                            1 => '1: Belum menunjukkan variasi sudut pandang.',
                            2 => '2: Satu sudut pandang dan pengembangannya terbatas.',
                            3 => '3: Menggunakan lebih dari 1 sudut pandang yang sesuai.',
                            4 => '4: Mengembangkan ide dengan sudut pandang unik dan kaya.'
                        ] as $val => $desc)
                            <label class="p-2.5 rounded-xl border border-outline-variant/40 hover:bg-gray-50 cursor-pointer flex flex-col justify-between text-[11px] leading-tight">
                                <input type="radio" name="flexibility_score" value="{{ $val }}" class="rubric-input text-secondary"
                                    {{ old('flexibility_score', $project->assessment->flexibility_score ?? 3) == $val ? 'checked' : '' }}>
                                <span class="mt-1 text-on-surface">{{ $desc }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Indikator 3: Originality -->
                <div class="space-y-2 border-b border-outline-variant/20 pb-4">
                    <div class="flex items-center justify-between">
                        <label class="text-xs md:text-sm font-bold text-primary flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-primary text-white text-xs flex items-center justify-center font-bold">3</span>
                            <span>Keaslian (Originality) - Slogan unik & tidak meniru</span>
                        </label>
                    </div>
                    <div class="grid grid-cols-4 gap-2 pt-1 text-xs">
                        @foreach([
                            1 => '1: Hampir seluruhnya meniru iklan yang sudah ada.',
                            2 => '2: Slogan masih banyak mengikuti contoh.',
                            3 => '3: Cukup menarik dan memiliki unsur berbeda.',
                            4 => '4: Sangat orisinal, unik, dan tidak meniru iklan televisi.'
                        ] as $val => $desc)
                            <label class="p-2.5 rounded-xl border border-outline-variant/40 hover:bg-gray-50 cursor-pointer flex flex-col justify-between text-[11px] leading-tight">
                                <input type="radio" name="originality_score" value="{{ $val }}" class="rubric-input text-secondary"
                                    {{ old('originality_score', $project->assessment->originality_score ?? 4) == $val ? 'checked' : '' }}>
                                <span class="mt-1 text-on-surface">{{ $desc }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Indikator 4: Elaboration -->
                <div class="space-y-2 border-b border-outline-variant/20 pb-4">
                    <div class="flex items-center justify-between">
                        <label class="text-xs md:text-sm font-bold text-primary flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-primary text-white text-xs flex items-center justify-center font-bold">4</span>
                            <span>Kerincian (Elaboration) - Kelengkapan pesan & detail visual</span>
                        </label>
                    </div>
                    <div class="grid grid-cols-4 gap-2 pt-1 text-xs">
                        @foreach([
                            1 => '1: Iklan belum dikembangkan secara lengkap.',
                            2 => '2: Pengembangan terbatas dan ada unsur penting hilang.',
                            3 => '3: Cukup lengkap dengan kalimat ajakan yang sesuai.',
                            4 => '4: Sangat lengkap dengan pesan, visual, dan unsur pendukung.'
                        ] as $val => $desc)
                            <label class="p-2.5 rounded-xl border border-outline-variant/40 hover:bg-gray-50 cursor-pointer flex flex-col justify-between text-[11px] leading-tight">
                                <input type="radio" name="elaboration_score" value="{{ $val }}" class="rubric-input text-secondary"
                                    {{ old('elaboration_score', $project->assessment->elaboration_score ?? 3) == $val ? 'checked' : '' }}>
                                <span class="mt-1 text-on-surface">{{ $desc }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Catatan / Umpan Balik Guru -->
                <div class="space-y-2">
                    <label for="notes" class="block text-xs font-bold text-primary uppercase tracking-wider">
                        Catatan & Masukan Pembimbing untuk Siswa:
                    </label>
                    <textarea name="notes" id="notes" rows="3"
                        class="w-full p-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary transition-all"
                        placeholder="Berikan apresiasi dan catatan perbaikan...">{{ old('notes', $project->assessment->notes ?? 'Konsep iklan sangat orisinal, berhasil mengangkat produk khas Pontianak tanpa meniru iklan televisi!') }}</textarea>
                </div>

                <!-- Action Button -->
                <div class="pt-2 flex justify-between items-center">
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-3 border-2 border-primary text-primary font-bold text-xs rounded-xl hover:bg-primary/5 transition-all">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3.5 bg-secondary text-white font-bold text-xs md:text-sm rounded-xl nav-btn-shadow hover:brightness-105 active:scale-[0.99] transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">save</span>
                        <span>Simpan Hasil Penilaian Rubrik</span>
                    </button>
                </div>
            </form>
        </div>

    </div>

</main>

<script>
    // Live update total score, percentage, and category badge
    const inputs = document.querySelectorAll('.rubric-input');
    function calculateRubric() {
        let total = 0;
        ['fluency_score', 'flexibility_score', 'originality_score', 'elaboration_score'].forEach(name => {
            const checked = document.querySelector(`input[name="${name}"]:checked`);
            if (checked) {
                total += parseInt(checked.value, 10);
            }
        });

        document.getElementById('totalScoreText').innerText = total;
        const percentage = ((total / 16) * 100).toFixed(1);
        document.getElementById('percentageText').innerText = percentage;

        let category = 'Kurang Kreatif';
        let badgeClass = 'bg-red-600';
        if (total >= 13) {
            category = 'Sangat Kreatif';
            badgeClass = 'bg-purple-600';
        } else if (total >= 10) {
            category = 'Kreatif';
            badgeClass = 'bg-green-600';
        } else if (total >= 7) {
            category = 'Cukup Kreatif';
            badgeClass = 'bg-amber-600';
        }

        const badge = document.getElementById('categoryBadge');
        badge.innerText = category;
        badge.className = `px-3 py-1 ${badgeClass} text-white rounded-full text-xs font-bold shadow-xs`;
    }

    inputs.forEach(input => input.addEventListener('change', calculateRubric));
</script>
@endsection
