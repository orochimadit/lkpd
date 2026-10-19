@extends('layouts.app', ['title' => 'Analisis N-Gain Motivasi Belajar'])

@section('content')
<main class="max-w-7xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">trending_up</span>
                <span>Analisis Efektivitas Variabel Y1 (Motivasi Belajar)</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-primary font-headline">Rekapitulasi Pretest, Posttest & Uji N-Gain</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">Data Pengukuran Peningkatan Motivasi Belajar Peserta Didik Kelas VI SDN 21 Pontianak Barat</p>
        </div>

        <a href="{{ route('admin.export.spss') }}" 
           class="px-5 py-2.5 bg-green-700 hover:bg-green-800 text-white font-bold text-xs md:text-sm rounded-xl shadow-md flex items-center gap-2 transition-all">
            <span class="material-symbols-outlined text-base">download</span>
            <span>Export Data SPSS (.CSV)</span>
        </a>
    </div>

    <!-- Summary N-Gain Banner -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="content-card p-6 border-2 border-secondary bg-gradient-to-br from-blue-50/50 to-white rounded-2xl">
            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider block mb-1">Rata-Rata N-Gain Kelas:</span>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-black text-secondary font-headline">{{ $averageNGain }}</span>
                <span class="text-xs text-on-surface-variant">Rentang 0.00 - 1.00</span>
            </div>
            <span class="inline-block mt-3 px-3 py-1 bg-secondary/10 text-secondary text-xs font-bold rounded-full">
                Kategori: {{ $averageCategory }}
            </span>
        </div>

        <div class="content-card p-6 border border-outline-variant/30 rounded-2xl flex flex-col justify-between">
            <div>
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider block mb-1">Rumus Perhitungan N-Gain Hake (1998):</span>
                <p class="text-xs text-primary font-mono bg-surface-container-low p-2 rounded-lg mt-2">
                    g = (Posttest - Pretest) / (Skor Maksimal - Pretest)
                </p>
            </div>
            <p class="text-[11px] text-gray-500 mt-2">Skor Maksimal Angket Motivasi = 40 (10 butir x 4 skala).</p>
        </div>

        <div class="content-card p-6 border border-outline-variant/30 rounded-2xl flex flex-col justify-between">
            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-wider block mb-1">Kriteria Pembagian N-Gain:</span>
            <div class="text-xs space-y-1 text-on-surface">
                <p><span class="font-bold text-green-700">• g &ge; 0.70</span> : Tinggi (Efektivitas Tinggi)</p>
                <p><span class="font-bold text-amber-700">• 0.30 &le; g &lt; 0.70</span> : Sedang (Cukup Efektif)</p>
                <p><span class="font-bold text-red-600">• g &lt; 0.30</span> : Rendah (Kurang Efektif)</p>
            </div>
        </div>
    </div>

    <!-- Table Pretest, Posttest & N-Gain -->
    <div class="content-card border border-outline-variant/30 rounded-2xl overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs md:text-sm">
                <thead class="bg-surface-container-low text-primary font-bold border-b border-outline-variant/30">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Nama Siswa</th>
                        <th class="p-4">NISN</th>
                        <th class="p-4 text-center">Pretest (Awal)</th>
                        <th class="p-4 text-center">Posttest (Akhir)</th>
                        <th class="p-4 text-center">Peningkatan (Gain)</th>
                        <th class="p-4 text-center">Skor N-Gain</th>
                        <th class="p-4 text-center">Kategori Efektivitas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 bg-white">
                    @forelse($students as $idx => $s)
                        @php
                            $g = $gains[$s->id] ?? null;
                            $diff = ($g && $g['pre'] !== null && $g['post'] !== null) ? ($g['post'] - $g['pre']) : null;
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 font-bold text-on-surface-variant">{{ $idx + 1 }}</td>
                            <td class="p-4 font-bold text-primary">{{ $s->name }}</td>
                            <td class="p-4 font-mono text-on-surface-variant">{{ $s->student ? $s->student->nisn : '-' }}</td>
                            
                            <td class="p-4 text-center font-bold">
                                {{ ($g && $g['pre'] !== null) ? $g['pre'] . '/40' : '-' }}
                            </td>
                            
                            <td class="p-4 text-center font-bold">
                                {{ ($g && $g['post'] !== null) ? $g['post'] . '/40' : '-' }}
                            </td>

                            <td class="p-4 text-center font-bold {{ ($diff !== null && $diff > 0) ? 'text-green-700' : 'text-gray-500' }}">
                                {{ $diff !== null ? ($diff > 0 ? "+{$diff}" : $diff) : '-' }}
                            </td>

                            <td class="p-4 text-center font-black font-mono text-base {{ ($g && $g['ngain'] !== null) ? 'text-secondary' : 'text-gray-400' }}">
                                {{ ($g && $g['ngain'] !== null) ? $g['ngain'] : '-' }}
                            </td>

                            <td class="p-4 text-center">
                                @if($g && $g['category'] === 'Tinggi')
                                    <span class="px-2.5 py-1 bg-green-50 text-green-700 border border-green-200 rounded-full text-[11px] font-bold">
                                        Tinggi
                                    </span>
                                @elseif($g && $g['category'] === 'Sedang')
                                    <span class="px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full text-[11px] font-bold">
                                        Sedang
                                    </span>
                                @elseif($g && $g['category'] === 'Rendah')
                                    <span class="px-2.5 py-1 bg-red-50 text-red-700 border border-red-200 rounded-full text-[11px] font-bold">
                                        Rendah
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full text-[11px]">
                                        Belum Lengkap
                                    </span>
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
    </div>

</main>
@endsection
