@extends('layouts.app', ['title' => 'Studio Proyek Iklan Kreatif'])

@section('content')
<main class="max-w-6xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-purple-700 uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">palette</span>
                <span>Proyek Kreatif Siswa Kelas VI</span>
            </div>
            <h1 class="text-2xl font-extrabold text-primary font-headline">Studio Rancang Iklan Kreatif Pontianak</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">
                Gunakan kreativitas dan ide orisinalmu untuk mempromosikan produk kebanggaan Kota Pontianak!
            </p>
        </div>

        @if($project && $project->assessment)
            <div class="p-3 bg-purple-50 border border-purple-200 rounded-xl text-xs flex items-center gap-3">
                <div class="w-10 h-10 bg-purple-600 text-white rounded-lg flex items-center justify-center font-bold text-lg">
                    {{ $project->assessment->total_score }}
                </div>
                <div>
                    <span class="text-on-surface-variant block text-[10px]">Nilai Rubrik Kreativitas (4-16)</span>
                    <span class="font-extrabold text-purple-900">{{ $project->assessment->category }} ({{ $project->assessment->percentage }}%)</span>
                </div>
            </div>
        @endif
    </div>

    <!-- Feedback Banner if assessed -->
    @if($project && $project->assessment && $project->assessment->notes)
        <div class="p-4 bg-green-50 border border-green-200 rounded-2xl flex items-start gap-3 shadow-xs">
            <span class="material-symbols-outlined text-green-600 text-2xl shrink-0">military_tech</span>
            <div class="text-xs space-y-1">
                <strong class="text-green-900 block font-bold">Catatan Penilaian Guru (Ibu Fildzah):</strong>
                <p class="text-green-800 leading-relaxed">{{ $project->assessment->notes }}</p>
                <div class="flex gap-4 pt-1 font-semibold text-green-950 text-[11px]">
                    <span>Fluency: {{ $project->assessment->fluency_score }}/4</span>
                    <span>Flexibility: {{ $project->assessment->flexibility_score }}/4</span>
                    <span>Originality: {{ $project->assessment->originality_score }}/4</span>
                    <span>Elaboration: {{ $project->assessment->elaboration_score }}/4</span>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Form Wizard (4 Guilford Steps) -->
        <div class="lg:col-span-7 content-card p-6 md:p-8 border border-outline-variant/30 space-y-6">
            <form action="{{ route('student.proyek.store') }}" method="POST" class="space-y-6" id="projectForm">
                @csrf

                <!-- Step 1: Fluency (Curah Ide Produk) -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-purple-600 text-white text-xs font-bold flex items-center justify-center">1</span>
                        <h3 class="text-sm font-bold text-primary font-headline">Langkah 1: Curah Ide Produk Lokal (Fluency)</h3>
                    </div>
                    <label for="product_type" class="block text-xs text-on-surface-variant leading-relaxed">
                        Pilih salah satu produk kearifan lokal Kota Pontianak yang ingin kamu iklankan:
                    </label>
                    <select name="product_type" id="product_type" required
                        class="w-full p-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary transition-all">
                        @foreach($pontianakProducts as $pName => $pDesc)
                            <option value="{{ $pName }}" {{ (old('product_type', $project->product_type ?? '') === $pName) ? 'selected' : '' }}>
                                {{ $pName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Step 2: Flexibility (Sudut Pandang Unik) -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-purple-600 text-white text-xs font-bold flex items-center justify-center">2</span>
                        <h3 class="text-sm font-bold text-primary font-headline">Langkah 2: Sudut Pandang Iklan (Flexibility)</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="angle_perspective" class="block text-[11px] font-bold text-on-surface-variant mb-1">Sudut Pandang Utama:</label>
                            <input type="text" name="angle_perspective" id="angle_perspective" required
                                value="{{ old('angle_perspective', $project->angle_perspective ?? 'Kesehatan Alami dari Khatulistiwa') }}"
                                class="w-full p-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs focus:outline-none focus:border-secondary transition-all"
                                placeholder="Contoh: Kesehatan, Tradisi, Rasa">
                        </div>
                        <div>
                            <label for="target_audience" class="block text-[11px] font-bold text-on-surface-variant mb-1">Sasaran Pembeli (Target):</label>
                            <input type="text" name="target_audience" id="target_audience" required
                                value="{{ old('target_audience', $project->target_audience ?? 'Anak-anak dan Keluarga') }}"
                                class="w-full p-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs focus:outline-none focus:border-secondary transition-all"
                                placeholder="Contoh: Remaja, Wisatawan">
                        </div>
                    </div>
                </div>

                <!-- Step 3: Originality (Slogan Orisinal) -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-purple-600 text-white text-xs font-bold flex items-center justify-center">3</span>
                        <h3 class="text-sm font-bold text-primary font-headline">Langkah 3: Slogan Orisinal Anti-Meniru (Originality)</h3>
                    </div>
                    <label for="slogan" class="block text-xs text-on-surface-variant leading-relaxed">
                        Tuliskan kalimat slogan yang <strong>unik, menarik, dan buatanmu sendiri</strong> (jangan meniru iklan TV atau iklan terkenal lainnya!):
                    </label>
                    <input type="text" name="slogan" id="slogan" required
                        value="{{ old('slogan', $project->slogan ?? 'Dinginnya Nyata, Khasiat Alaminya Bikin Semangat!') }}"
                        class="w-full p-3.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm font-bold text-primary focus:outline-none focus:border-secondary transition-all"
                        placeholder="Tuliskan slogan buatanmu di sini...">
                </div>

                <!-- Step 4: Elaboration (Kerincian Pesan & Visual) -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-purple-600 text-white text-xs font-bold flex items-center justify-center">4</span>
                        <h3 class="text-sm font-bold text-primary font-headline">Langkah 4: Kerincian Pesan & Visual (Elaboration)</h3>
                    </div>
                    <label for="persuasive_text" class="block text-xs text-on-surface-variant leading-relaxed">
                        Tuliskan kalimat penjelas (isi iklan) yang memuat informasi keunggulan dan kalimat ajakan yang meyakinkan:
                    </label>
                    <textarea name="persuasive_text" id="persuasive_text" rows="3" required
                        class="w-full p-3.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary transition-all"
                        placeholder="Contoh: Dibuat dari daging lidah buaya pilihan petani Siantan. Rasakan kesegarannya hari ini di gerai terdekat!">{{ old('persuasive_text', $project->persuasive_text ?? 'Rasakan sensasi kenyal lidah buaya asli Pontianak yang dipetik segar setiap pagi. Tanpa pengawet buatan, pas dinikmati bersama teman!') }}</textarea>

                    <label for="visual_layout" class="block text-xs text-on-surface-variant leading-relaxed pt-2">
                        Rencana Tata Letak Gambar / Visual Poster:
                    </label>
                    <input type="text" name="visual_layout" id="visual_layout"
                        value="{{ old('visual_layout', $project->visual_layout ?? 'Ilustrasi gelas es lidah buaya dengan potongan jeruk nipis dan latar Tugu Khatulistiwa') }}"
                        class="w-full p-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs focus:outline-none focus:border-secondary transition-all"
                        placeholder="Deskripsikan gambar atau ornamen yang akan ditampilkan pada poster">
                </div>

                <div class="pt-4 flex justify-between items-center border-t border-outline-variant/20">
                    <a href="{{ route('student.dashboard') }}" class="px-5 py-3 border-2 border-primary text-primary font-bold text-xs rounded-xl hover:bg-primary/5 transition-all">
                        &larr; Beranda
                    </a>
                    <button type="submit" class="px-8 py-3.5 bg-secondary text-white font-bold text-xs md:text-sm rounded-xl nav-btn-shadow hover:brightness-105 active:scale-[0.99] transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">send</span>
                        <span>Kumpulkan Karya ke Guru</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Live Poster Preview -->
        <div class="lg:col-span-5 sticky top-20 space-y-4">
            <div class="content-card p-5 border border-purple-200 rounded-2xl shadow-md bg-gradient-to-b from-white to-purple-50/20">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-purple-900 uppercase tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">visibility</span>
                        <span>Pratinjau Poster Digital</span>
                    </span>
                    <span class="text-[10px] bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full font-semibold">Live Preview</span>
                </div>

                <!-- Poster Box -->
                <div class="rounded-xl overflow-hidden border-2 border-primary/20 bg-gradient-to-br from-[#021541] via-[#003882] to-[#0060ac] text-white p-6 text-center space-y-4 shadow-lg">
                    <div class="inline-block bg-white/90 text-primary px-3 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest" id="previewBadge">
                        PRODUK KHAS PONTIANAK
                    </div>

                    <div class="w-full h-44 bg-white/10 rounded-xl border border-white/20 p-4 flex flex-col justify-center items-center backdrop-blur-xs">
                        <div class="text-4xl mb-1">✨</div>
                        <h4 class="font-extrabold text-sm text-secondary-fixed" id="previewProduct">
                            {{ $project->product_type ?? 'Es Lidah Buaya Segar Siantan' }}
                        </h4>
                        <p class="text-[10px] text-gray-300 italic mt-1 max-w-[200px]" id="previewVisual">
                            {{ $project->visual_layout ?? 'Ilustrasi gelas es lidah buaya dengan potongan jeruk nipis' }}
                        </p>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-xl font-black font-headline text-yellow-300 leading-tight" id="previewSlogan">
                            "{{ $project->slogan ?? 'Dinginnya Nyata, Khasiat Alaminya Bikin Semangat!' }}"
                        </h3>
                        <p class="text-[11px] text-gray-200 leading-relaxed" id="previewBody">
                            {{ $project->persuasive_text ?? 'Rasakan sensasi kenyal lidah buaya asli Pontianak yang dipetik segar setiap pagi. Tanpa pengawet!' }}
                        </p>
                    </div>

                    <div class="pt-2">
                        <span class="inline-block w-full py-2 bg-yellow-400 text-primary font-extrabold rounded-lg text-xs shadow-md">
                            Dukung Produk Lokal Pontianak!
                        </span>
                    </div>
                </div>

                <p class="text-[11px] text-center text-on-surface-variant mt-3 italic">
                    Poster ini otomatis diperbarui saat kamu mengubah teks di formulir sebelah kiri.
                </p>
            </div>
        </div>

    </div>

</main>

<script>
    // Live update preview poster
    const productSelect = document.getElementById('product_type');
    const sloganInput = document.getElementById('slogan');
    const bodyInput = document.getElementById('persuasive_text');
    const visualInput = document.getElementById('visual_layout');

    productSelect.addEventListener('change', () => {
        document.getElementById('previewProduct').innerText = productSelect.value;
    });
    sloganInput.addEventListener('input', () => {
        document.getElementById('previewSlogan').innerText = '"' + (sloganInput.value || 'Slogan Anda') + '"';
    });
    bodyInput.addEventListener('input', () => {
        document.getElementById('previewBody').innerText = bodyInput.value || 'Teks iklan...';
    });
    visualInput.addEventListener('input', () => {
        document.getElementById('previewVisual').innerText = visualInput.value || 'Deskripsi visual...';
    });
</script>
@endsection
