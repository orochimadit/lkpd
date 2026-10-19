@extends('layouts.app', ['title' => 'Video Pembelajaran'])

@section('content')
<main class="max-w-5xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-primary font-headline">Video Pembelajaran Interaktif</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">Saksikan contoh iklan produk lokal dan perhatikan cara penyampaian pesannya!</p>
        </div>
        <a href="{{ route('student.dashboard') }}" class="text-xs font-bold text-secondary flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-sm">home</span>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Video Box Card -->
    <div class="content-card overflow-hidden border border-outline-variant/30">
        <div class="bg-black aspect-video relative flex items-center justify-center group overflow-hidden">
            <!-- Simulated Video Player with Poster -->
            <div class="absolute inset-0 bg-cover bg-center opacity-85" style="background-image: url('https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=1200&auto=format&fit=crop');"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>

            <div class="relative z-10 text-center text-white p-6 max-w-lg space-y-4">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-red-600/90 text-white rounded-full mx-auto flex items-center justify-center cursor-pointer shadow-xl hover:scale-110 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-4xl md:text-5xl" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-secondary-fixed bg-white/20 px-3 py-1 rounded-full">Video Edukasi Kelas VI</span>
                    <h3 class="text-lg md:text-2xl font-bold mt-2 font-headline">"Bedah Iklan Minuman Khatulistiwa: Pesan, Fakta, dan Opini"</h3>
                    <p class="text-xs text-gray-300 mt-1">Durasi: 4 Menit • Bahasa Indonesia SD</p>
                </div>
            </div>

            <!-- Video Controls Bar -->
            <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black to-transparent flex items-center justify-between text-white text-xs">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined cursor-pointer hover:text-secondary-fixed">play_circle</span>
                    <span>01:15 / 04:20</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined cursor-pointer hover:text-secondary-fixed">volume_up</span>
                    <span class="material-symbols-outlined cursor-pointer hover:text-secondary-fixed">fullscreen</span>
                </div>
            </div>
        </div>

        <div class="p-6 md:p-8 space-y-4">
            <h3 class="text-lg font-bold text-primary font-headline">Poin Penting yang Perlu Kamu Amati dalam Video:</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs md:text-sm">
                <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/30">
                    <span class="font-bold text-red-600 block mb-1">1. Nada Suara & Intonasi</span>
                    Perhatikan bagaimana pengisi suara menggunakan kalimat ajakan yang bersemangat namun tetap bersahabat.
                </div>
                <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/30">
                    <span class="font-bold text-red-600 block mb-1">2. Fakta yang Ditonjolkan</span>
                    Temukan bahan alami yang digunakan pada produk minuman lidah buaya yang ditayangkan.
                </div>
                <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/30">
                    <span class="font-bold text-red-600 block mb-1">3. Orisinalitas Ide</span>
                    Lihat bagaimana latar Tugu Khatulistiwa Pontianak dimasukkan untuk memperkuat ciri khas lokal.
                </div>
            </div>

            <div class="pt-4 flex justify-between items-center border-t border-outline-variant/20">
                <a href="{{ route('student.materi.show', 'materi-4-kearifan-lokal') }}" class="px-5 py-2.5 border-2 border-primary text-primary font-bold text-xs md:text-sm rounded-xl hover:bg-primary/5 transition-all">
                    &larr; Kembali ke Materi
                </a>
                <a href="{{ route('student.lkpd.index') }}" class="px-6 py-2.5 bg-secondary text-white font-bold text-xs md:text-sm rounded-xl nav-btn-shadow hover:brightness-105 transition-all flex items-center gap-1.5">
                    <span>Lanjut Kerjakan LKPD Digital</span>
                    <span class="material-symbols-outlined text-lg">edit_document</span>
                </a>
            </div>
        </div>
    </div>

</main>
@endsection
