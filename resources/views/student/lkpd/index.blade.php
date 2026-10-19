@extends('layouts.app', ['title' => 'LKPD Digital Aktivitas 1'])

@section('content')
<main class="max-w-6xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Top Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-secondary uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">assignment</span>
                <span>Lembar Kerja Peserta Didik (LKPD) Interaktif</span>
            </div>
            <h1 class="text-2xl font-extrabold text-primary font-headline">Aktivitas 1: Menganalisis Unsur & Fakta Iklan</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">Amati stimulus iklan di sebelah kiri, lalu jawab pertanyaan analisis secara kritis!</p>
        </div>

        @if($submission && $submission->status === 'submitted')
            <div class="flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 border border-green-200 rounded-xl text-xs font-bold">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                <span>LKPD Telah Dikumpulkan</span>
                @if($submission->score)
                    <span class="ml-2 px-2 py-0.5 bg-green-200 rounded-md">Nilai: {{ $submission->score }}/100</span>
                @endif
            </div>
        @endif
    </div>

    <!-- Split-Screen Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Side: Interactive Stimulus Ad -->
        <div class="lg:col-span-5 sticky top-20 space-y-4">
            <div class="content-card p-4 border border-outline-variant/40 rounded-2xl overflow-hidden shadow-md">
                
                <!-- Ad Visual Card Simulation: Pontianak Aloe Vera -->
                <div class="rounded-xl overflow-hidden bg-gradient-to-br from-[#0060ac] to-[#021541] p-6 text-white text-center relative space-y-4">
                    
                    <div class="inline-block bg-white/90 text-primary px-4 py-1 rounded-full text-[11px] font-extrabold tracking-wider shadow-sm">
                        MINUMAN KHAS KHATULISTIWA
                    </div>

                    <!-- Product Mockup Visual Box -->
                    <div class="w-full h-52 bg-gradient-to-t from-emerald-600/30 to-white/10 rounded-2xl border-2 border-white/30 p-4 flex flex-col justify-end items-center relative overflow-hidden backdrop-blur-xs shadow-inner">
                        <div class="text-5xl mb-2">🥤</div>
                        <div class="bg-black/40 backdrop-blur-md px-3 py-1 rounded-lg text-xs font-bold">
                            Es Lidah Buaya Siantan
                        </div>
                    </div>

                    <div class="space-y-1">
                        <h3 class="text-2xl font-black font-headline text-secondary-fixed">Segar Alami Tiada Tanding!</h3>
                        <p class="text-xs text-gray-200 font-medium">100% Daging Lidah Buaya Asli Panen Petani Siantan • Tanpa Pemanis Buatan</p>
                    </div>

                    <div class="pt-2 flex items-center justify-center gap-2">
                        <span class="px-3 py-1 bg-emerald-500 text-white text-[10px] font-bold rounded-md">✓ Bersertifikat Halal</span>
                        <span class="px-3 py-1 bg-amber-400 text-primary text-[10px] font-bold rounded-md">Pilihan Keluarga Cerdas</span>
                    </div>

                    <button type="button" class="w-full py-2.5 bg-secondary-fixed text-primary font-bold rounded-xl text-xs shadow-md">
                        Dapatkan di Gerai Resmi Pontianak Sekarang!
                    </button>
                </div>

                <div class="mt-3 text-center">
                    <p class="text-[11px] font-bold text-on-surface-variant uppercase tracking-wider">Stimulus Iklan Media Cetak: Es Lidah Buaya Siantan</p>
                </div>
            </div>

            <!-- Tip Card -->
            <div class="p-4 bg-secondary/10 border-l-4 border-secondary rounded-xl text-xs space-y-1">
                <span class="font-bold text-secondary flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">lightbulb</span>
                    <span>Petunjuk Mengerjakan</span>
                </span>
                <p class="text-on-surface-variant leading-relaxed">
                    Perhatikan kata-kata yang menyatakan keunggulan nyata (fakta) dan kalimat yang bersifat pujian berlebihan (opini).
                </p>
            </div>
        </div>

        <!-- Right Side: Task Form -->
        <div class="lg:col-span-7 content-card p-6 md:p-8 border border-outline-variant/30 space-y-6">
            
            <form action="{{ route('student.lkpd.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Question 1: Ad Purpose -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">1</span>
                        <h3 class="text-sm font-bold text-primary font-headline">Analisis Tujuan Iklan</h3>
                    </div>
                    <label for="ad_purpose" class="block text-xs text-on-surface-variant leading-relaxed">
                        Berdasarkan pengamatanmu pada iklan di samping, <strong>apa tujuan utama iklan tersebut</strong>? Jelaskan siapa sasaran pembaca iklan tersebut!
                    </label>
                    <textarea name="ad_purpose" id="ad_purpose" rows="3" required
                        class="w-full p-3.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all"
                        placeholder="Tuliskan analisis tujuan iklan di sini...">{{ old('ad_purpose', $submission->ad_purpose ?? '') }}</textarea>
                </div>

                <!-- Question 2: Product Advantage -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">2</span>
                        <h3 class="text-sm font-bold text-primary font-headline">Identifikasi Keunggulan Produk</h3>
                    </div>
                    <label for="product_advantage" class="block text-xs text-on-surface-variant leading-relaxed">
                        Sebutkan produk apa yang ditawarkan dan <strong>apa saja keunggulan atau manfaat</strong> yang disampaikan dalam iklan tersebut?
                    </label>
                    <textarea name="product_advantage" id="product_advantage" rows="3" required
                        class="w-full p-3.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all"
                        placeholder="Sebutkan keunggulan produk yang kamu temukan...">{{ old('product_advantage', $submission->product_advantage ?? '') }}</textarea>
                </div>

                <!-- Question 3: Critical Thinking - Fact vs Opinion -->
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">3</span>
                        <h3 class="text-sm font-bold text-primary font-headline">Analisis Kritis: Fakta vs Opini</h3>
                    </div>
                    <label for="fact_opinion_analysis" class="block text-xs text-on-surface-variant leading-relaxed">
                        Temukan minimal <strong>1 kalimat fakta</strong> dan <strong>1 kalimat opini</strong> yang terdapat pada iklan tersebut. Jelaskan mengapa kalimat tersebut disebut fakta atau opini!
                    </label>
                    <textarea name="fact_opinion_analysis" id="fact_opinion_analysis" rows="4" required
                        class="w-full p-3.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all"
                        placeholder="Contoh:&#10;- Kalimat Fakta: ... (karena ...)&#10;- Kalimat Opini: ... (karena ...)">{{ old('fact_opinion_analysis', $submission->fact_opinion_analysis ?? '') }}</textarea>
                </div>

                <!-- Feedback from teacher if reviewed -->
                @if($submission && $submission->teacher_feedback)
                    <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-xs space-y-1">
                        <span class="font-bold text-green-900 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">comment</span>
                            <span>Catatan & Umpan Balik Guru:</span>
                        </span>
                        <p class="text-green-800">{{ $submission->teacher_feedback }}</p>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="pt-4 flex flex-col sm:flex-row gap-3 border-t border-outline-variant/20">
                    <button type="submit" name="action" value="draft" 
                            class="px-5 py-3 border-2 border-primary text-primary font-bold text-xs rounded-xl hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-base">save</span>
                        <span>Simpan Draf</span>
                    </button>

                    <button type="submit" name="action" value="submit" 
                            class="flex-1 px-6 py-3 bg-secondary text-white font-bold text-xs rounded-xl nav-btn-shadow hover:brightness-105 active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-base">send</span>
                        <span>Kumpulkan Jawaban ke Guru</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

</main>
@endsection
