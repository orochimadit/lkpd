@extends('layouts.app', ['title' => 'Dashboard Guru & Peneliti'])

@section('content')
<main class="max-w-7xl mx-auto px-4 py-6 md:py-8 w-full space-y-8">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-primary uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">dashboard</span>
                <span>Portal Peneliti Tesis & Guru Kelas VI</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-primary font-headline">Monitoring Pembelajaran & Penilaian Tesis</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">SD Negeri 21 Pontianak Barat • Subjek Penelitian: 26 Peserta Didik</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.export.spss') }}" 
               class="px-5 py-2.5 bg-green-700 hover:bg-green-800 text-white font-bold text-xs md:text-sm rounded-xl shadow-md flex items-center gap-2 transition-all">
                <span class="material-symbols-outlined text-lg">table_chart</span>
                <span>Download Rekap Data SPSS (.CSV)</span>
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="content-card p-5 border border-outline-variant/30 rounded-2xl">
            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider block mb-1">Total Subjek Siswa</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-extrabold text-primary font-headline">{{ $totalStudents }}</span>
                <span class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined">groups</span>
                </span>
            </div>
            <span class="text-[11px] text-on-surface-variant mt-2 block">Kelas VI C SDN 21 Pontianak</span>
        </div>

        <div class="content-card p-5 border border-outline-variant/30 rounded-2xl">
            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider block mb-1">Karya Iklan Masuk</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-extrabold text-purple-700 font-headline">{{ $submittedProjects }}</span>
                <span class="w-10 h-10 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined">palette</span>
                </span>
            </div>
            <span class="text-[11px] text-on-surface-variant mt-2 block">Dari target 26 karya iklan</span>
        </div>

        <div class="content-card p-5 border border-outline-variant/30 rounded-2xl">
            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider block mb-1">Sudah Dinilai Rubrik</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-extrabold text-green-700 font-headline">{{ $assessedProjects }}</span>
                <span class="w-10 h-10 rounded-xl bg-green-50 text-green-700 flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined">rule</span>
                </span>
            </div>
            <span class="text-[11px] text-on-surface-variant mt-2 block">Rubrik Guilford 4 Indikator</span>
        </div>

        <div class="content-card p-5 border border-outline-variant/30 rounded-2xl">
            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider block mb-1">Rata-Rata Kuis</span>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-extrabold text-secondary font-headline">{{ $averageQuizScore }}</span>
                <span class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined">quiz</span>
                </span>
            </div>
            <span class="text-[11px] text-on-surface-variant mt-2 block">Skala 0 - 100</span>
        </div>
    </div>

    <!-- Student Table -->
    <section class="content-card border border-outline-variant/30 rounded-2xl overflow-hidden shadow-xs">
        <div class="p-6 border-b border-outline-variant/30 flex justify-between items-center bg-surface">
            <div>
                <h3 class="font-extrabold text-primary font-headline text-lg">Daftar Progres & Karya Peserta Didik</h3>
                <p class="text-xs text-on-surface-variant mt-0.5">Pantau status belajar dan berikan penilaian rubrik pada karya iklan siswa:</p>
            </div>
            <span class="text-xs font-bold text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $totalStudents }} Siswa Terdaftar</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs md:text-sm">
                <thead class="bg-surface-container-low text-primary font-bold border-b border-outline-variant/30">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Nama Siswa</th>
                        <th class="p-4">NISN</th>
                        <th class="p-4 text-center">LKPD</th>
                        <th class="p-4 text-center">Skor Kuis</th>
                        <th class="p-4 text-center">Pre/Post Motivasi</th>
                        <th class="p-4 text-center">Karya Iklan Kreatif</th>
                        <th class="p-4 text-center">Aksi Penilaian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 bg-white">
                    @forelse($students as $idx => $s)
                        @php
                            $lkpd = $s->lkpdSubmissions->first();
                            $quiz = $s->quizAttempts->sortByDesc('created_at')->first();
                            $pre = $s->motivationSurveys->where('survey_type', 'pretest')->first();
                            $post = $s->motivationSurveys->where('survey_type', 'posttest')->first();
                            $proj = $s->creativeProjects->first();
                            $assess = $proj ? $proj->assessment : null;
                        @endphp
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-4 font-bold text-on-surface-variant">{{ $idx + 1 }}</td>
                            <td class="p-4">
                                <span class="font-bold text-primary block">{{ $s->name }}</span>
                                <span class="text-[11px] text-on-surface-variant">{{ $s->student ? $s->student->class_name : 'VI C' }}</span>
                            </td>
                            <td class="p-4 text-on-surface-variant font-mono">{{ $s->student ? $s->student->nisn : '-' }}</td>
                            
                            <!-- LKPD -->
                            <td class="p-4 text-center">
                                @if($lkpd)
                                    <span class="px-2.5 py-1 bg-green-50 text-green-700 border border-green-200 rounded-full text-[11px] font-bold">
                                        ✓ Masuk {{ $lkpd->score ? "({$lkpd->score})" : '' }}
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full text-[11px]">Belum</span>
                                @endif
                            </td>

                            <!-- Kuis -->
                            <td class="p-4 text-center font-bold">
                                @if($quiz)
                                    <span class="text-secondary">{{ $quiz->score }}/100</span>
                                @else
                                    <span class="text-gray-400 font-normal">-</span>
                                @endif
                            </td>

                            <!-- Motivasi -->
                            <td class="p-4 text-center text-[11px]">
                                <span class="{{ $pre ? 'text-green-700 font-semibold' : 'text-gray-400' }}">Pre: {{ $pre ? $pre->total_score : '-' }}</span> / 
                                <span class="{{ $post ? 'text-green-700 font-semibold' : 'text-gray-400' }}">Post: {{ $post ? $post->total_score : '-' }}</span>
                            </td>

                            <!-- Proyek Iklan & Status -->
                            <td class="p-4 text-center">
                                @if($proj)
                                    @if($assess)
                                        <span class="px-2.5 py-1 bg-purple-50 text-purple-700 border border-purple-200 rounded-full text-[11px] font-bold block">
                                            {{ $assess->category }} ({{ $assess->total_score }}/16)
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full text-[11px] font-bold block">
                                            Perlu Dinilai
                                        </span>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-xs">Belum Membuat</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="p-4 text-center">
                                @if($proj)
                                    <a href="{{ route('admin.project.show', $proj->id) }}" 
                                       class="px-3 py-1.5 {{ $assess ? 'bg-gray-100 text-primary hover:bg-gray-200' : 'bg-secondary text-white hover:brightness-105' }} rounded-xl text-xs font-bold transition-all inline-flex items-center gap-1 shadow-xs">
                                        <span class="material-symbols-outlined text-sm">{{ $assess ? 'visibility' : 'rate_review' }}</span>
                                        <span>{{ $assess ? 'Lihat / Edit' : 'Nilai Rubrik' }}</span>
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-on-surface-variant text-sm">Belum ada siswa terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</main>
@endsection
