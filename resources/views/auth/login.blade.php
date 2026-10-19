@extends('layouts.app', ['title' => 'Masuk'])

@section('content')
<div class="min-h-[calc(100vh-8rem)] flex items-center justify-center p-4">
    <div class="w-full max-w-md content-card p-8 border border-outline-variant/30 relative overflow-hidden">
        
        <!-- Header Branding -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-primary rounded-2xl mx-auto flex items-center justify-center text-white shadow-md mb-4">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">auto_stories</span>
            </div>
            <h1 class="text-2xl font-extrabold text-primary font-headline">Cerdas Beriklan</h1>
            <p class="text-sm text-on-surface-variant mt-1">E-Modul Pembelajaran Interaktif Materi Iklan<br><span class="font-semibold text-secondary">SD Negeri 21 Pontianak Barat</span></p>
        </div>

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Username / NISN</label>
                <div class="relative">
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus
                        class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all"
                        placeholder="Masukkan username atau NISN">
                    <span class="material-symbols-outlined absolute right-3 top-3 text-on-surface-variant/60">person</span>
                </div>
                @error('username')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 bg-surface-container-low border border-outline-variant/60 rounded-xl text-sm focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition-all"
                        placeholder="Masukkan password">
                    <span class="material-symbols-outlined absolute right-3 top-3 text-on-surface-variant/60">lock</span>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-on-surface-variant">
                    <input type="checkbox" name="remember" class="rounded text-secondary focus:ring-secondary">
                    <span>Ingat saya di perangkat ini</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-secondary text-white font-bold rounded-xl text-sm nav-btn-shadow hover:brightness-105 active:scale-[0.99] transition-all flex items-center justify-center gap-2 mt-2">
                <span>Masuk Sekarang</span>
                <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </button>
        </form>

        <!-- Demo Quick Login Helper for Testing -->
        <div class="mt-8 pt-6 border-t border-outline-variant/30 text-center">
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-wider mb-3">⚡ Akses Cepat Demo (Pengujian)</p>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('quick-login', 'siswa') }}" class="p-2.5 bg-secondary/10 hover:bg-secondary/20 text-secondary border border-secondary/20 rounded-xl text-xs font-bold transition-colors flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-base">school</span>
                    <span>Masuk Siswa</span>
                </a>
                <a href="{{ route('quick-login', 'guru') }}" class="p-2.5 bg-primary/10 hover:bg-primary/20 text-primary border border-primary/20 rounded-xl text-xs font-bold transition-colors flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-base">supervisor_account</span>
                    <span>Masuk Guru</span>
                </a>
            </div>
            <p class="text-[11px] text-on-surface-variant/70 mt-3">Akun default: Siswa (`siswa1` / `password`), Guru (`guru` / `password`)</p>
        </div>

    </div>
</div>
@endsection
