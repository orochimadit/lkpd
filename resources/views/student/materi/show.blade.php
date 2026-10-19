@extends('layouts.app', ['title' => $topic['title']])

@section('content')
<main class="max-w-6xl mx-auto px-4 py-6 md:py-8 w-full flex-1 flex flex-col md:flex-row gap-8">
    
    <!-- Sidebar Navigasi Topik (Desktop) -->
    <aside class="w-full md:w-72 shrink-0 space-y-4">
        <div class="content-card p-5 border border-outline-variant/30">
            <h3 class="text-sm font-extrabold text-primary font-headline uppercase tracking-wider mb-1">Daftar Topik Materi</h3>
            <p class="text-xs text-on-surface-variant mb-4">Materi Iklan Bahasa Indonesia Kelas VI</p>
            
            <nav class="space-y-1 text-xs">
                <a href="{{ route('student.materi.show', 'materi-1-pengertian') }}" 
                   class="flex items-center gap-2.5 p-3 rounded-xl font-bold transition-all {{ $topic['slug'] === 'materi-1-pengertian' ? 'bg-secondary text-white shadow-sm' : 'text-on-surface hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-base">info</span>
                    <span>1. Pengertian & Tujuan</span>
                </a>

                <a href="{{ route('student.materi.show', 'materi-2-unsur') }}" 
                   class="flex items-center gap-2.5 p-3 rounded-xl font-bold transition-all {{ $topic['slug'] === 'materi-2-unsur' ? 'bg-secondary text-white shadow-sm' : 'text-on-surface hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-base">category</span>
                    <span>2. Unsur & Struktur Iklan</span>
                </a>

                <a href="{{ route('student.materi.show', 'materi-3-fakta-opini') }}" 
                   class="flex items-center gap-2.5 p-3 rounded-xl font-bold transition-all {{ $topic['slug'] === 'materi-3-fakta-opini' ? 'bg-secondary text-white shadow-sm' : 'text-on-surface hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-base">fact_check</span>
                    <span>3. Fakta vs Opini Iklan</span>
                </a>

                <a href="{{ route('student.materi.show', 'materi-4-kearifan-lokal') }}" 
                   class="flex items-center gap-2.5 p-3 rounded-xl font-bold transition-all {{ $topic['slug'] === 'materi-4-kearifan-lokal' ? 'bg-secondary text-white shadow-sm' : 'text-on-surface hover:bg-surface-container-high' }}">
                    <span class="material-symbols-outlined text-base">location_on</span>
                    <span>4. Kearifan Lokal Pontianak</span>
                </a>
            </nav>
        </div>

        <!-- Shortcut card -->
        <div class="content-card p-5 border border-outline-variant/30 bg-secondary/5 text-xs">
            <h4 class="font-bold text-secondary mb-2 flex items-center gap-1.5">
                <span class="material-symbols-outlined text-sm">tips_and_updates</span>
                <span>Tips Membaca</span>
            </h4>
            <p class="text-on-surface-variant leading-relaxed">
                Pelajari materi ini dengan saksama karena contoh-contoh di sini akan membantumu mengerjakan <strong>LKPD Digital</strong> dan membuat <strong>Proyek Iklan</strong>!
            </p>
        </div>
    </aside>

    <!-- Konten Utama Materi -->
    <article class="flex-1 content-card border border-outline-variant/30 overflow-hidden flex flex-col justify-between">
        <div>
            <!-- Header Topik -->
            <header class="bg-primary-container text-white px-6 md:px-8 py-6">
                <div class="flex items-center gap-2 text-secondary-fixed text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="material-symbols-outlined text-sm">book</span>
                    <span>E-Modul Interaktif Materi Iklan</span>
                </div>
                <h1 class="text-xl md:text-3xl font-extrabold font-headline leading-tight">{{ $topic['title'] }}</h1>
            </header>

            <div class="p-6 md:p-8 space-y-6 text-sm md:text-base leading-relaxed text-on-surface">
                
                @if($topic['slug'] === 'materi-1-pengertian')
                    <!-- Topik 1 -->
                    <div class="space-y-4">
                        <p class="text-base md:text-lg font-medium text-primary">
                            Halo adik-adik hebat kelas VI! Pernahkah kamu melihat gambar es lidah buaya yang segar di pinggir Jalan Ahmad Yani? Atau mendengar ajakan membeli kue bingke di radio dan televisi?
                        </p>
                        <p class="text-on-surface-variant">
                            Nah, semua itu disebut dengan <strong class="text-secondary font-bold">Iklan</strong>. Secara sederhana, iklan adalah pemberitahuan yang bertujuan untuk <strong>mendorong, membujuk, atau mengajak</strong> khalayak ramai agar tertarik pada barang atau jasa yang ditawarkan.
                        </p>
                    </div>

                    <div class="p-5 bg-secondary/10 border-l-4 border-secondary rounded-r-2xl space-y-2">
                        <h3 class="font-bold text-secondary flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined text-lg">lightbulb</span>
                            <span>Ingat ya!</span>
                        </h3>
                        <p class="italic text-xs md:text-sm text-primary">
                            "Tujuan utama iklan adalah menarik perhatian, menyampaikan informasi penting, dan meyakinkan orang lain agar memilih produk atau melakukan ajakan tersebut."
                        </p>
                    </div>

                    <div class="space-y-3 pt-2">
                        <h3 class="font-extrabold text-primary font-headline text-lg">Mengapa Iklan Sangat Dibutuhkan?</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-xs md:text-sm">
                            <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/30">
                                <span class="font-bold text-secondary block mb-1">1. Memberi Informasi</span>
                                Memberitahu masyarakat tentang adanya produk baru, fungsi, atau kelebihannya.
                            </div>
                            <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/30">
                                <span class="font-bold text-secondary block mb-1">2. Membujuk (Persuasif)</span>
                                Meyakinkan calon pembeli bahwa produk tersebut bermanfaat dan berkualitas.
                            </div>
                            <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/30">
                                <span class="font-bold text-secondary block mb-1">3. Mengingatkan</span>
                                Menjaga agar masyarakat selalu ingat akan produk lokal kebanggaan daerah.
                            </div>
                        </div>
                    </div>

                @elseif($topic['slug'] === 'materi-2-unsur')
                    <!-- Topik 2 -->
                    <div class="space-y-4">
                        <p class="text-on-surface-variant">
                            Agar sebuah iklan berhasil menarik perhatian orang yang melihatnya, pembuat iklan harus menyusun <strong>unsur-unsur penting</strong> secara lengkap dan tertata rapi.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-surface-container-low rounded-2xl border border-outline-variant/30 space-y-2">
                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs">1</div>
                            <h4 class="font-bold text-primary text-sm">Judul Iklan (Headline)</h4>
                            <p class="text-xs text-on-surface-variant">Bagian paling mencolok di bagian atas. Menggunakan kalimat singkat, padat, dan membuat penasaran.</p>
                        </div>

                        <div class="p-4 bg-surface-container-low rounded-2xl border border-outline-variant/30 space-y-2">
                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs">2</div>
                            <h4 class="font-bold text-primary text-sm">Nama Produk & Jasa</h4>
                            <p class="text-xs text-on-surface-variant">Identitas produk yang diiklankan agar pembaca tahu persis apa yang sedang ditawarkan.</p>
                        </div>

                        <div class="p-4 bg-surface-container-low rounded-2xl border border-outline-variant/30 space-y-2">
                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs">3</div>
                            <h4 class="font-bold text-primary text-sm">Isi & Penjelasan (Body Text)</h4>
                            <p class="text-xs text-on-surface-variant">Menjelaskan keunggulan produk secara jujur, bahan pembuatan, atau manfaat yang didapatkan.</p>
                        </div>

                        <div class="p-4 bg-surface-container-low rounded-2xl border border-outline-variant/30 space-y-2">
                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs">4</div>
                            <h4 class="font-bold text-primary text-sm">Kalimat Ajakan (Call to Action)</h4>
                            <p class="text-xs text-on-surface-variant">Kalimat yang mendorong tindakan segera, contoh: <em>"Beli sekarang di gerai terdekat!", "Rasakan sensasinya hari ini!"</em>.</p>
                        </div>
                    </div>

                    <div class="p-5 bg-amber-50 border-l-4 border-amber-500 rounded-r-2xl space-y-1 text-xs md:text-sm">
                        <h4 class="font-bold text-amber-800 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base">verified</span>
                            <span>Ciri Bahasa Iklan yang Efektif:</span>
                        </h4>
                        <ul class="list-disc list-inside text-amber-900 space-y-1 pt-1">
                            <li>Menggunakan bahasa yang santun, menarik, dan mudah dipahami.</li>
                            <li>Tidak bertele-tele dan langsung pada intinya.</li>
                            <li>Bersifat sugestif (memberikan pengaruh baik bagi yang membaca).</li>
                        </ul>
                    </div>

                @elseif($topic['slug'] === 'materi-3-fakta-opini')
                    <!-- Topik 3: Fakta vs Opini -->
                    <div class="space-y-4">
                        <p class="text-on-surface-variant">
                            Sebagai siswa yang cerdas dan kritis, kita tidak boleh langsung percaya begitu saja pada semua kata-kata manis di dalam iklan. Di dalam sebuah iklan, terdapat dua jenis kalimat: <strong>Fakta</strong> dan <strong>Opini</strong>.
                        </p>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-outline-variant/40 shadow-xs">
                        <table class="w-full text-left text-xs md:text-sm">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="p-3.5">Ciri Pembeda</th>
                                    <th class="p-3.5 bg-blue-900">Kalimat FAKTA</th>
                                    <th class="p-3.5 bg-amber-800">Kalimat OPINI</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/20 bg-white">
                                <tr>
                                    <td class="p-3.5 font-bold text-primary">Pengertian</td>
                                    <td class="p-3.5 text-on-surface-variant">Hal yang benar-benar ada, nyata, dan dapat dibuktikan kebenarannya dengan data.</td>
                                    <td class="p-3.5 text-on-surface-variant">Pendapat, perkiraan, atau penilaian pribadi yang sifatnya subjektif.</td>
                                </tr>
                                <tr>
                                    <td class="p-3.5 font-bold text-primary">Ciri Kata Kunci</td>
                                    <td class="p-3.5 text-on-surface-variant">Menyebutkan angka, ukuran pasti, bahan asli, tanggal, sertifikasi resmi (BPOM/Halal).</td>
                                    <td class="p-3.5 text-on-surface-variant">Menggunakan kata: <em>"paling", "terbaik", "nomor satu", "dijamin", "paling enak"</em>.</td>
                                </tr>
                                <tr>
                                    <td class="p-3.5 font-bold text-primary">Contoh di Iklan</td>
                                    <td class="p-3.5 text-blue-900 font-medium"><em>"Minuman ini dibuat dari 100% lidah buaya asli Siantan Pontianak berbobot 300 gram."</em></td>
                                    <td class="p-3.5 text-amber-900 font-medium"><em>"Minuman paling nikmat tiada tara yang bikin harimu selalu sempurna!"</em></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-5 bg-green-50 border-l-4 border-green-600 rounded-r-2xl space-y-1 text-xs md:text-sm">
                        <h4 class="font-bold text-green-900 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-base">psychology</span>
                            <span>Sikap Kritis yang Harus Dimiliki Siswa:</span>
                        </h4>
                        <p class="text-green-800">
                            Ketika melihat kata <strong>"Terbaik di Dunia"</strong> atau <strong>"Satu-satunya yang Paling Ampuh"</strong>, tanyakan pada dirimu: <em>"Apakah ada bukti data laboratoriumnya? Atau itu hanya pendapat penjualnya saja?"</em>
                        </p>
                    </div>

                @elseif($topic['slug'] === 'materi-4-kearifan-lokal')
                    <!-- Topik 4: Kearifan Lokal Pontianak -->
                    <div class="space-y-4">
                        <p class="text-on-surface-variant">
                            Kota Pontianak kaya akan budaya dan produk unik yang sangat potensial untuk dipromosikan ke seluruh Indonesia bahkan dunia. Mengangkat produk lokal dalam iklan melatih kita untuk <strong>berpikir orisinal dan tidak hanya meniru iklan televisi nasional</strong>!
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-white rounded-2xl border border-outline-variant/30 shadow-xs space-y-2">
                            <div class="h-28 bg-gradient-to-r from-emerald-100 to-teal-50 rounded-xl flex items-center justify-center text-emerald-800 font-bold text-center p-2">
                                🌿 Es & Olahan Lidah Buaya Siantan
                            </div>
                            <h4 class="font-bold text-primary text-sm">Lidah Buaya (Aloe Vera) Pontianak</h4>
                            <p class="text-xs text-on-surface-variant">Tanaman lidah buaya raksasa khas Pontianak yang terkenal memiliki daging tebal, segar, dan menyehatkan pencernaan.</p>
                            <span class="inline-block text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full">Ide Slogan: "Segar Alaminya dari Khatulistiwa!"</span>
                        </div>

                        <div class="p-4 bg-white rounded-2xl border border-outline-variant/30 shadow-xs space-y-2">
                            <div class="h-28 bg-gradient-to-r from-blue-100 to-indigo-50 rounded-xl flex items-center justify-center text-blue-800 font-bold text-center p-2">
                                🎨 Kain Tenun Motif Corak Insang
                            </div>
                            <h4 class="font-bold text-primary text-sm">Tenun Corak Insang</h4>
                            <p class="text-xs text-on-surface-variant">Kain tradisional Melayu Pontianak bermotif insang ikan bernilai filosofis tinggi tentang kegigihan masyarakat sungai Kapuas.</p>
                            <span class="inline-block text-[11px] font-semibold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full">Ide Slogan: "Anggun Berbudaya, Warisan Nusantara."</span>
                        </div>

                        <div class="p-4 bg-white rounded-2xl border border-outline-variant/30 shadow-xs space-y-2">
                            <div class="h-28 bg-gradient-to-r from-amber-100 to-yellow-50 rounded-xl flex items-center justify-center text-amber-800 font-bold text-center p-2">
                                🥧 Kue Bingke Berendam Tradisional
                            </div>
                            <h4 class="font-bold text-primary text-sm">Kue Bingke Berendam</h4>
                            <p class="text-xs text-on-surface-variant">Kue manis bertekstur legit lembut dengan aroma daun pandan dan santan asli yang selalu dicari wisatawan.</p>
                            <span class="inline-block text-[11px] font-semibold text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-full">Ide Slogan: "Manisnya Legit, Bikin Kangen Pontianak!"</span>
                        </div>

                        <div class="p-4 bg-white rounded-2xl border border-outline-variant/30 shadow-xs space-y-2">
                            <div class="h-28 bg-gradient-to-r from-orange-100 to-amber-50 rounded-xl flex items-center justify-center text-orange-800 font-bold text-center p-2">
                                🍌 Pisang Goreng Selai Srikaya
                            </div>
                            <h4 class="font-bold text-primary text-sm">Pisang Goreng Srikaya</h4>
                            <p class="text-xs text-on-surface-variant">Pisang goreng renyah panas dipadu olesan selai srikaya gurih manis khas kedai kopi legendaris Pontianak.</p>
                            <span class="inline-block text-[11px] font-semibold text-orange-700 bg-orange-50 px-2.5 py-0.5 rounded-full">Ide Slogan: "Kriuk Gurihnya Berpadu Manis yang Sempurna."</span>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- Footer Navigasi Materi -->
        <footer class="p-6 bg-surface-container-low border-t border-outline-variant/30 flex justify-between items-center gap-4">
            @if($topic['prev_slug'])
                <a href="{{ route('student.materi.show', $topic['prev_slug']) }}" 
                   class="px-5 py-2.5 border-2 border-primary text-primary font-bold text-xs md:text-sm rounded-xl hover:bg-primary/5 transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    <span>Topik Sebelumnya</span>
                </a>
            @else
                <a href="{{ route('student.dashboard') }}" 
                   class="px-5 py-2.5 border-2 border-outline-variant text-on-surface-variant font-bold text-xs md:text-sm rounded-xl hover:bg-gray-100 transition-all flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-lg">home</span>
                    <span>Ke Beranda</span>
                </a>
            @endif

            @if($topic['next_slug'] && $topic['next_slug'] !== 'video-pembelajaran')
                <a href="{{ route('student.materi.show', $topic['next_slug']) }}" 
                   class="px-6 py-2.5 bg-secondary text-white font-bold text-xs md:text-sm rounded-xl nav-btn-shadow hover:brightness-105 transition-all flex items-center gap-1.5">
                    <span>Lanjut Topik Berikutnya</span>
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </a>
            @else
                <a href="{{ route('student.video.index') }}" 
                   class="px-6 py-2.5 bg-secondary text-white font-bold text-xs md:text-sm rounded-xl nav-btn-shadow hover:brightness-105 transition-all flex items-center gap-1.5">
                    <span>Selesai Materi &rarr; Buka Video</span>
                    <span class="material-symbols-outlined text-lg">play_circle</span>
                </a>
            @endif
        </footer>
    </article>

</main>
@endsection
