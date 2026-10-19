@extends('layouts.app', ['title' => 'Penilaian LKPD Digital'])

@section('content')
<main class="max-w-7xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-green-700 uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">edit_document</span>
                <span>Lembar Kerja Peserta Didik Digital</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-primary font-headline">Daftar Pengumpulan & Penilaian LKPD</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">Aktivitas 1: Menganalisis Unsur, Fakta, dan Opini Iklan Minuman Khatulistiwa</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-primary flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>

    <!-- Table LKPD Submissions -->
    <div class="content-card border border-outline-variant/30 rounded-2xl overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs md:text-sm">
                <thead class="bg-surface-container-low text-primary font-bold border-b border-outline-variant/30">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Nama Siswa</th>
                        <th class="p-4">NISN</th>
                        <th class="p-4">Stimulus Iklan</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Nilai (0-100)</th>
                        <th class="p-4 text-center">Aksi Penilaian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 bg-white">
                    @forelse($submissions as $idx => $sub)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 font-bold text-on-surface-variant">{{ $idx + 1 }}</td>
                            <td class="p-4 font-bold text-primary">{{ $sub->user->name }}</td>
                            <td class="p-4 font-mono text-on-surface-variant">{{ $sub->user->student ? $sub->user->student->nisn : '-' }}</td>
                            <td class="p-4 text-on-surface-variant">{{ $sub->stimulus_title }}</td>
                            <td class="p-4 text-center">
                                @if($sub->status === 'reviewed')
                                    <span class="px-2.5 py-1 bg-green-50 text-green-700 border border-green-200 rounded-full text-[11px] font-bold">
                                        ✓ Sudah Dinilai
                                    </span>
                                @elseif($sub->status === 'submitted')
                                    <span class="px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full text-[11px] font-bold">
                                        Perlu Diperiksa
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 bg-gray-100 text-gray-500 rounded-full text-[11px]">
                                        Draf
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center font-bold">
                                @if($sub->score)
                                    <span class="text-green-700 text-base">{{ $sub->score }}</span>
                                @else
                                    <span class="text-gray-400 font-normal">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.lkpd.show', $sub->id) }}" 
                                   class="px-3.5 py-1.5 bg-secondary text-white hover:brightness-105 rounded-xl text-xs font-bold transition-all inline-flex items-center gap-1 shadow-xs">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                    <span>Periksa & Beri Nilai</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-on-surface-variant text-sm">Belum ada siswa yang mengumpulkan LKPD Digital.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>
@endsection
