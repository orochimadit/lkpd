@extends('layouts.app', ['title' => 'Kuis Tantangan'])

@section('content')
<main class="max-w-4xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">quiz</span>
                <span>Uji Pemahaman Siswa</span>
            </div>
            <h1 class="text-2xl font-extrabold text-primary font-headline">Kuis Tantangan Interaktif</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">Jawablah 5 pertanyaan di bawah ini dengan cermat untuk menguji pemahamanmu!</p>
        </div>

        @if($latestAttempt)
            <div class="px-4 py-2 bg-amber-50 border border-amber-200 rounded-xl text-xs flex items-center gap-2">
                <span class="material-symbols-outlined text-amber-600 text-lg">military_tech</span>
                <div>
                    <span class="text-on-surface-variant block text-[10px]">Skor Terakhirmu</span>
                    <span class="font-extrabold text-amber-700 text-sm">{{ $latestAttempt->score }}/100</span>
                </div>
            </div>
        @endif
    </div>

    <!-- Result Banner If Just Submitted -->
    @if(session('quiz_result'))
        <div class="content-card p-6 border-2 border-secondary bg-gradient-to-r from-blue-50 via-white to-amber-50 rounded-2xl shadow-md space-y-4 text-center">
            <div class="w-16 h-16 bg-secondary text-white rounded-full mx-auto flex items-center justify-center shadow-lg">
                <span class="material-symbols-outlined text-4xl">emoji_events</span>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-secondary">Hasil Kuis Selesai!</span>
                <h2 class="text-3xl font-black text-primary font-headline mt-1">Skor Kamu: {{ session('score') }} / 100</h2>
                <p class="text-xs text-on-surface-variant mt-1">
                    Kamu berhasil menjawab dengan benar <strong>{{ session('correctCount') }}</strong> dari {{ session('totalQuestions') }} soal.
                </p>
            </div>
            <div class="inline-flex items-center gap-1 text-amber-500 text-2xl">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= (session('score') / 20))
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    @else
                        <span class="material-symbols-outlined text-gray-300">star</span>
                    @endif
                @endfor
            </div>
        </div>
    @endif

    <!-- Form Kuis -->
    <form action="{{ route('student.quiz.submit') }}" method="POST" class="space-y-6">
        @csrf

        @foreach($questions as $id => $q)
            @php
                $detail = session('details')[$id] ?? null;
            @endphp
            <div class="content-card p-6 border border-outline-variant/30 rounded-2xl space-y-4 {{ $detail ? ($detail['is_correct'] ? 'border-l-4 border-l-green-500' : 'border-l-4 border-l-red-500') : '' }}">
                <div class="flex items-start gap-3">
                    <span class="w-8 h-8 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center shrink-0">
                        {{ $id }}
                    </span>
                    <div class="space-y-1">
                        <h3 class="text-sm md:text-base font-bold text-primary font-headline">{{ $q['question'] }}</h3>
                    </div>
                </div>

                <!-- Pilihan Jawaban -->
                <div class="grid grid-cols-1 gap-2.5 pt-2 pl-0 md:pl-11">
                    @foreach($q['options'] as $key => $opt)
                        @php
                            $isChecked = old("answers.$id") === $key;
                            $isDetailCorrect = $detail && $key === $detail['correct_answer'];
                            $isUserWrong = $detail && $key === $detail['user_answer'] && !$detail['is_correct'];
                        @endphp
                        <label class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all text-xs md:text-sm
                            {{ $isDetailCorrect ? 'bg-green-50 border-green-500 text-green-950 font-bold' : '' }}
                            {{ $isUserWrong ? 'bg-red-50 border-red-500 text-red-950 line-through' : '' }}
                            {{ !$detail ? 'border-outline-variant/50 hover:bg-surface-container-high' : '' }}
                        ">
                            <input type="radio" name="answers[{{ $id }}]" value="{{ $key }}" required {{ $isChecked ? 'checked' : '' }}
                                   class="text-secondary focus:ring-secondary w-4 h-4">
                            <span class="w-6 h-6 rounded-md bg-primary/10 text-primary font-bold text-xs flex items-center justify-center shrink-0">{{ $key }}</span>
                            <span class="flex-1">{{ $opt }}</span>
                            @if($isDetailCorrect)
                                <span class="material-symbols-outlined text-green-600 text-sm">check_circle</span>
                            @endif
                        </label>
                    @endforeach
                </div>

                <!-- Explanation Box if submitted -->
                @if($detail)
                    <div class="mt-3 p-3 bg-gray-50 rounded-xl text-xs text-on-surface-variant border border-outline-variant/30 pl-11">
                        <strong class="text-primary block mb-0.5">Penjelasan Guru:</strong>
                        {{ $detail['explanation'] }}
                    </div>
                @endif
            </div>
        @endforeach

        <!-- Action Button -->
        <div class="pt-2 flex justify-between items-center">
            <a href="{{ route('student.dashboard') }}" class="px-5 py-3 border-2 border-primary text-primary font-bold text-xs rounded-xl hover:bg-primary/5 transition-all">
                &larr; Beranda
            </a>
            <button type="submit" class="px-8 py-3.5 bg-secondary text-white font-bold text-sm rounded-xl nav-btn-shadow hover:brightness-105 active:scale-[0.99] transition-all flex items-center gap-2">
                <span>Kirim Jawaban Kuis</span>
                <span class="material-symbols-outlined text-lg">send</span>
            </button>
        </div>
    </form>

</main>
@endsection
