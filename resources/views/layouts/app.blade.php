<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'E-Modul Iklan' }} - Cerdas Beriklan Kelas VI SD</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via CDN for instant zero-friction compatibility + built styles) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#021541',
                        'primary-container': '#1a2b56',
                        'primary-fixed': '#dae1ff',
                        'on-primary-fixed-variant': '#354572',
                        secondary: '#0060ac',
                        'secondary-container': '#d4e3ff',
                        'on-secondary-container': '#003e73',
                        surface: '#fbf8fd',
                        'surface-container-low': '#f5f3f7',
                        'surface-container-high': '#e9e7ec',
                        'surface-container-lowest': '#ffffff',
                        background: '#f5f7fa',
                        'on-surface': '#1b1b1f',
                        'on-surface-variant': '#45464f',
                        'outline-variant': '#c5c6d0',
                    },
                    fontFamily: {
                        headline: ['Plus Jakarta Sans', 'sans-serif'],
                        body: ['Be Vietnam Pro', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Be Vietnam Pro', sans-serif; background-color: #F5F7FA; }
        h1, h2, h3, h4, .font-headline { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .content-card { background: white; box-shadow: 0 8px 30px rgba(2, 21, 65, 0.05); border-radius: 16px; }
        .nav-btn-shadow { box-shadow: 0 4px 0px #003e73; }
        .nav-btn-shadow:active { transform: translateY(2px); box-shadow: 0 2px 0px #003e73; }
        .card-elevation { box-shadow: 0 4px 20px rgba(2, 21, 65, 0.06); }
    </style>
</head>
<body class="text-on-surface bg-background min-h-screen flex flex-col">

    <!-- Top Navigation Bar -->
    <header class="flex justify-between items-center px-4 md:px-12 py-3 w-full h-16 z-50 bg-white shadow-sm fixed top-0 left-0 border-b border-outline-variant/40">
        <div class="flex items-center gap-3">
            <a href="{{ auth()->check() && auth()->user()->isGuru() ? route('admin.dashboard') : route('student.dashboard') }}" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-sm">
                    <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
                </div>
                <div>
                    <span class="font-headline text-lg md:text-xl font-extrabold text-primary tracking-tight">Cerdas Beriklan</span>
                    <span class="hidden md:inline-block text-xs px-2 py-0.5 ml-2 bg-secondary/10 text-secondary font-semibold rounded-full">Kelas VI SD</span>
                </div>
            </a>
        </div>

        <nav class="hidden md:flex items-center gap-6">
            @if(auth()->check() && auth()->user()->isGuru())
                <a href="{{ route('admin.dashboard') }}" class="font-semibold text-sm {{ request()->routeIs('admin.dashboard*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary' }}">Dashboard Guru</a>
                <a href="{{ route('admin.export.spss') }}" class="font-semibold text-sm text-green-700 hover:text-green-800 flex items-center gap-1 bg-green-50 px-3 py-1.5 rounded-lg border border-green-200">
                    <span class="material-symbols-outlined text-base">download</span> Export Data SPSS
                </a>
            @else
                <a href="{{ route('student.dashboard') }}" class="font-semibold text-sm {{ request()->routeIs('student.dashboard') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary' }}">Beranda</a>
                <a href="{{ route('student.materi.index') }}" class="font-semibold text-sm {{ request()->routeIs('student.materi*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary' }}">Materi</a>
                <a href="{{ route('student.video.index') }}" class="font-semibold text-sm {{ request()->routeIs('student.video*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary' }}">Video</a>
                <a href="{{ route('student.lkpd.index') }}" class="font-semibold text-sm {{ request()->routeIs('student.lkpd*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary' }}">LKPD Digital</a>
                <a href="{{ route('student.quiz.index') }}" class="font-semibold text-sm {{ request()->routeIs('student.quiz*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary' }}">Kuis</a>
                <a href="{{ route('student.proyek.index') }}" class="font-semibold text-sm {{ request()->routeIs('student.proyek*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary' }}">Proyek Iklan</a>
                <a href="{{ route('student.evaluasi.index') }}" class="font-semibold text-sm {{ request()->routeIs('student.evaluasi*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-secondary' }}">Evaluasi</a>
            @endif
        </nav>

        <div class="flex items-center gap-3">
            @if(auth()->check())
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-xs font-bold text-primary">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] text-on-surface-variant capitalize">{{ auth()->user()->role == 'guru' ? 'Guru / Peneliti' : 'Siswa Kelas VI' }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 text-on-surface-variant hover:text-red-600 rounded-lg transition-colors flex items-center" title="Keluar">
                        <span class="material-symbols-outlined text-xl">logout</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-secondary text-white text-xs font-bold rounded-lg nav-btn-shadow">Masuk</a>
            @endif
        </div>
    </header>

    <!-- Main Container -->
    <div class="flex-1 pt-16 flex flex-col">
        <!-- Flash Messages -->
        <div class="max-w-6xl mx-auto px-4 mt-4 w-full">
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-200 flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 border border-red-200 flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-red-600">error</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if(session('info'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-xl bg-blue-50 border border-blue-200 flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-blue-600">info</span>
                    <span>{{ session('info') }}</span>
                </div>
            @endif
        </div>

        @yield('content')
    </div>

    <!-- Mobile Bottom Navigation Bar (Siswa Only) -->
    @if(auth()->check() && auth()->user()->isSiswa())
        <nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-2 py-2 md:hidden bg-white shadow-lg border-t border-outline-variant/30">
            <a href="{{ route('student.dashboard') }}" class="flex flex-col items-center py-1 px-2 {{ request()->routeIs('student.dashboard') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('student.dashboard') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">home</span>
                <span class="text-[10px]">Beranda</span>
            </a>
            <a href="{{ route('student.materi.index') }}" class="flex flex-col items-center py-1 px-2 {{ request()->routeIs('student.materi*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('student.materi*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">menu_book</span>
                <span class="text-[10px]">Materi</span>
            </a>
            <a href="{{ route('student.lkpd.index') }}" class="flex flex-col items-center py-1 px-2 {{ request()->routeIs('student.lkpd*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('student.lkpd*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">edit_document</span>
                <span class="text-[10px]">LKPD</span>
            </a>
            <a href="{{ route('student.quiz.index') }}" class="flex flex-col items-center py-1 px-2 {{ request()->routeIs('student.quiz*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('student.quiz*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">quiz</span>
                <span class="text-[10px]">Kuis</span>
            </a>
            <a href="{{ route('student.proyek.index') }}" class="flex flex-col items-center py-1 px-2 {{ request()->routeIs('student.proyek*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('student.proyek*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">lightbulb</span>
                <span class="text-[10px]">Proyek</span>
            </a>
        </nav>
        <div class="h-14 md:hidden"></div>
    @endif

    <!-- Footer -->
    <footer class="w-full bg-white border-t border-outline-variant/30 py-6 px-4 md:px-12 text-center md:flex md:justify-between items-center text-xs text-on-surface-variant mt-auto">
        <p>© 2026 E-Modul Pembelajaran Interaktif Materi Iklan • SD Negeri 21 Pontianak Barat</p>
        <p class="mt-2 md:mt-0 font-medium text-primary">Penelitian Tesis: Fildzah Rahmawati (Magister PGSD FKIP UNTAN)</p>
    </footer>

</body>
</html>
