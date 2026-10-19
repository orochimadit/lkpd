@extends('layouts.app', ['title' => 'Beranda Siswa'])

@section('content')
<main class="max-w-6xl mx-auto px-4 py-6 md:py-10 w-full space-y-8">
    
    <!-- Hero Greeting & Progress Section -->
    <section class="bg-gradient-to-r from-primary to-[#002875] text-white rounded-3xl p-6 md:p-10 relative overflow-hidden shadow-xl">
        <div class="relative z-10 max-w-2xl space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/15 backdrop-blur-md text-secondary-fixed rounded-full text-xs font-bold uppercase tracking-wider">
                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                <span>Bahasa Indonesia Kelas VI • SDN 21 Pontianak Barat</span>
            </div>
            
            <h1 class="text-2xl md:text-4xl font-extrabold font-headline leading-tight">
                Halo, {{ $user->name }}! 👋<br>
                <span class="text-secondary-fixed">Siap Jadi Pembuat Iklan yang Kreatif?</span>
            </h1>
            
            <p class="text-sm md:text-base text-gray-200 leading-relaxed">
                Jelajahi materi seru tentang iklan, pelajari kearifan lokal Kota Pontianak, asah kemampuan berpikir kritismu, dan buat iklan orisinal buatanmu sendiri!
            </p>

            <!-- Progress Indicator -->
            <div class="pt-4 max-w-lg">
                <div class="flex justify-between items-center text-xs font-bold mb-2">
                    <span class="text-gray-300">Capaian Belajarmu</span>
                    <span class="text-secondary-fixed text-sm">{{ $progressPercent }}% Selesai ({{ $completedCount }}/{{ $totalModules }} Modul)</span>
                </div>
                <div class="w-full h-3 bg-white/20 rounded-full overflow-hidden p-0.5">
                    <div class="h-full bg-secondary-fixed rounded-full transition-all duration-700" style="width: {{ max($progressPercent, 5) }}%"></div>
                </div>
            </div>
        </div>

        <div class="absolute right-[-20px] bottom-[-30px] opacity-15 pointer-events-none hidden md:block">
            <span class="material-symbols-outlined text-[320px]">campaign</span>
        </div>
    </section>

    <!-- Bento Grid Menu Navigasi -->
    <section class="space-y-4">
        <div class="flex justify-between items-end">
            <div>
                <h2 class="text-xl md:text-2xl font-extrabold text-primary font-headline">Petualangan Belajar</h2>
                <p class="text-xs md:text-sm text-on-surface-variant">Pilih menu di bawah ini untuk memulai atau melanjutkan aktivitasmu:</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5">
            
            <!-- Large Card: Eksplorasi Materi -->
            <div class="md:col-span-2 md:row-span-2 content-card p-6 md:p-8 flex flex-col justify-between border border-outline-variant/30 hover:border-secondary transition-all hover:shadow-lg group relative overflow-hidden">
                <div class="relative z-10 space-y-4">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">menu_book</span>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 bg-secondary/10 text-secondary rounded-md">4 Topik Pembelajaran</span>
                    <h3 class="text-2xl font-extrabold text-primary font-headline group-hover:text-secondary transition-colors">Eksplorasi Materi Iklan</h3>
                    <p class="text-sm text-on-surface-variant leading-relaxed">
                        Pelajari pengertian iklan, struktur unsur pembentuk, perbedaan tajam fakta vs opini, dan ragam contoh iklan produk khas Pontianak.
                    </p>
                </div>
                <div class="pt-6 relative z-10 flex items-center justify-between">
                    <a href="{{ route('student.materi.index') }}" class="px-6 py-3 bg-secondary text-white font-bold text-sm rounded-xl nav-btn-shadow flex items-center gap-2 hover:brightness-105 transition-all">
                        <span>Buka Materi</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </a>
                    @if(in_array('materi-1-pengertian', $completedSlugs))
                        <span class="text-xs font-bold text-green-700 bg-green-50 px-3 py-1 rounded-full border border-green-200 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">check_circle</span> Sedang Dipelajari
                        </span>
                    @endif
                </div>
                <span class="material-symbols-outlined absolute -bottom-8 -right-8 text-9xl text-gray-100 pointer-events-none group-hover:text-secondary/5 transition-colors">article</span>
            </div>

            <!-- Card: Video Pembelajaran -->
            <div class="content-card p-6 flex flex-col justify-between border border-outline-variant/30 hover:border-red-400 transition-all hover:shadow-lg group">
                <div class="space-y-3">
                    <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">play_circle</span>
                    </div>
                    <h4 class="font-extrabold text-primary font-headline text-lg group-hover:text-red-600 transition-colors">Video Interaktif</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">Saksikan tayangan contoh iklan menarik dan bedah unsur-unsurnya bersama.</p>
                </div>
                <div class="pt-4 flex justify-between items-center">
                    <a href="{{ route('student.video.index') }}" class="text-xs font-bold text-red-600 flex items-center gap-1 hover:underline">
                        <span>Tonton Video</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                    @if(in_array('video-pembelajaran', $completedSlugs))
                        <span class="material-symbols-outlined text-green-600 text-lg">check_circle</span>
                    @endif
                </div>
            </div>

            <!-- Card: LKPD Digital -->
            <div class="content-card p-6 flex flex-col justify-between border border-outline-variant/30 hover:border-green-400 transition-all hover:shadow-lg group">
                <div class="space-y-3">
                    <div class="w-12 h-12 bg-green-50 text-green-700 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">edit_document</span>
                    </div>
                    <h4 class="font-extrabold text-primary font-headline text-lg group-hover:text-green-700 transition-colors">LKPD Digital</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">Lembar Kerja Analisis iklan minuman lidah buaya khas Pontianak.</p>
                </div>
                <div class="pt-4 flex justify-between items-center">
                    <a href="{{ route('student.lkpd.index') }}" class="text-xs font-bold text-green-700 flex items-center gap-1 hover:underline">
                        <span>Kerjakan LKPD</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                    @if(in_array('lkpd-digital', $completedSlugs))
                        <span class="material-symbols-outlined text-green-600 text-lg">check_circle</span>
                    @endif
                </div>
            </div>

            <!-- Card: Kuis Tantangan -->
            <div class="content-card p-6 flex flex-col justify-between border border-outline-variant/30 hover:border-amber-400 transition-all hover:shadow-lg group">
                <div class="space-y-3">
                    <div class="w-12 h-12 bg-amber-50 text-amber-700 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">quiz</span>
                    </div>
                    <h4 class="font-extrabold text-primary font-headline text-lg group-hover:text-amber-700 transition-colors">Kuis Tantangan</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">Uji pemahamanmu, dapatkan umpan balik langsung dan raih skor 100!</p>
                </div>
                <div class="pt-4 flex justify-between items-center">
                    <a href="{{ route('student.quiz.index') }}" class="text-xs font-bold text-amber-700 flex items-center gap-1 hover:underline">
                        <span>Mulai Kuis</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                    @if(in_array('kuis-tantangan', $completedSlugs))
                        <span class="material-symbols-outlined text-green-600 text-lg">check_circle</span>
                    @endif
                </div>
            </div>

            <!-- Card: Studio Proyek Iklan Kreatif (Guilford) -->
            <div class="content-card p-6 flex flex-col justify-between border border-outline-variant/30 hover:border-purple-400 transition-all hover:shadow-lg group bg-gradient-to-br from-white to-purple-50/30">
                <div class="space-y-3">
                    <div class="w-12 h-12 bg-purple-50 text-purple-700 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">lightbulb</span>
                    </div>
                    <h4 class="font-extrabold text-primary font-headline text-lg group-hover:text-purple-700 transition-colors">Studio Iklan Kreatif</h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed">Rancang poster iklan produk khas Pontianak dengan ide orisinalmu sendiri.</p>
                </div>
                <div class="pt-4 flex justify-between items-center">
                    <a href="{{ route('student.proyek.index') }}" class="text-xs font-bold text-purple-700 flex items-center gap-1 hover:underline">
                        <span>Buka Studio</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                    @if(in_array('proyek-kreatif', $completedSlugs))
                        <span class="material-symbols-outlined text-green-600 text-lg">check_circle</span>
                    @endif
                </div>
            </div>

            <!-- Card: Evaluasi & Angket Motivasi -->
            <div class="md:col-span-2 content-card p-6 flex flex-col justify-between border border-outline-variant/30 hover:border-blue-400 transition-all hover:shadow-lg group">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-700 rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">assignment_turned_in</span>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-primary font-headline text-lg group-hover:text-blue-700 transition-colors">Evaluasi & Refleksi Belajar</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed mt-1">Isi lembar refleksi dan angket motivasi belajar untuk mengukur kemajuan belajarmu.</p>
                    </div>
                </div>
                <div class="pt-4 flex justify-between items-center border-t border-outline-variant/20 mt-4">
                    <a href="{{ route('student.evaluasi.index') }}" class="text-xs font-bold text-blue-700 flex items-center gap-1 hover:underline">
                        <span>Isi Evaluasi & Angket</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                    @if(in_array('evaluasi', $completedSlugs))
                        <span class="material-symbols-outlined text-green-600 text-lg">check_circle</span>
                    @endif
                </div>
            </div>

        </div>
    </section>

    <!-- Learning Objectives Card -->
    <section class="content-card p-6 md:p-8 border border-outline-variant/30 bg-surface">
        <h3 class="text-lg font-bold text-primary font-headline mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-secondary">verified</span>
            <span>Target Capaian Pembelajaran (Kurikulum Merdeka Kelas VI)</span>
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs text-on-surface">
            <div class="p-4 bg-white rounded-xl border border-outline-variant/30 shadow-xs flex items-start gap-2">
                <span class="w-6 h-6 rounded-full bg-secondary/10 text-secondary font-bold flex items-center justify-center shrink-0">1</span>
                <span>Menganalisis pesan dan informasi dalam iklan media cetak dan elektronik.</span>
            </div>
            <div class="p-4 bg-white rounded-xl border border-outline-variant/30 shadow-xs flex items-start gap-2">
                <span class="w-6 h-6 rounded-full bg-secondary/10 text-secondary font-bold flex items-center justify-center shrink-0">2</span>
                <span>Membedakan secara kritis antara kalimat fakta dan kalimat opini dalam iklan.</span>
            </div>
            <div class="p-4 bg-white rounded-xl border border-outline-variant/30 shadow-xs flex items-start gap-2">
                <span class="w-6 h-6 rounded-full bg-secondary/10 text-secondary font-bold flex items-center justify-center shrink-0">3</span>
                <span>Mengidentifikasi unsur-unsur iklan yang persuasif, jujur, dan komunikatif.</span>
            </div>
            <div class="p-4 bg-white rounded-xl border border-outline-variant/30 shadow-xs flex items-start gap-2">
                <span class="w-6 h-6 rounded-full bg-secondary/10 text-secondary font-bold flex items-center justify-center shrink-0">4</span>
                <span>Merancang karya iklan kreatif berbasis potensi kearifan lokal Kota Pontianak.</span>
            </div>
        </div>
    </section>

</main>
@endsection
