@extends('layouts.app', ['title' => 'Kelola Data Siswa'])

@section('content')
<main class="max-w-7xl mx-auto px-4 py-6 md:py-8 w-full space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-outline-variant/30 pb-4">
        <div>
            <div class="inline-flex items-center gap-1.5 text-xs font-bold text-primary uppercase tracking-wider mb-1">
                <span class="material-symbols-outlined text-sm">groups</span>
                <span>Manajemen Subjek Penelitian</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-primary font-headline">Kelola Data Siswa (Subjek Riset)</h1>
            <p class="text-xs md:text-sm text-on-surface-variant">SD Negeri 21 Pontianak Barat • Kelas VI</p>
        </div>

        <button type="button" onclick="openAddModal()" 
                class="px-5 py-2.5 bg-secondary text-white font-bold text-xs md:text-sm rounded-xl nav-btn-shadow hover:brightness-105 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">person_add</span>
            <span>Tambah Siswa Baru</span>
        </button>
    </div>

    <!-- Filter & Search -->
    <div class="content-card p-4 border border-outline-variant/30 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4">
        <form action="{{ route('admin.students.index') }}" method="GET" class="w-full sm:w-80 flex items-center gap-2">
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NISN, atau username..." 
                       class="w-full pl-9 pr-4 py-2 bg-surface-container-low border border-outline-variant/50 rounded-xl text-xs focus:outline-none focus:border-secondary">
                <span class="material-symbols-outlined absolute left-2.5 top-2.5 text-on-surface-variant/60 text-sm">search</span>
            </div>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-xl text-xs font-bold hover:bg-primary-container transition-colors">
                Cari
            </button>
        </form>

        <span class="text-xs font-bold text-on-surface-variant">
            Total Siswa Terdaftar: <strong class="text-primary text-sm">{{ $students->count() }}</strong>
        </span>
    </div>

    <!-- Student Table -->
    <div class="content-card border border-outline-variant/30 rounded-2xl overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs md:text-sm">
                <thead class="bg-surface-container-low text-primary font-bold border-b border-outline-variant/30">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">NISN</th>
                        <th class="p-4">Nama Lengkap</th>
                        <th class="p-4">Username</th>
                        <th class="p-4 text-center">Kelas</th>
                        <th class="p-4 text-center">L/P</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 bg-white">
                    @forelse($students as $idx => $s)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 font-bold text-on-surface-variant">{{ $idx + 1 }}</td>
                            <td class="p-4 font-mono font-bold text-primary">{{ $s->student ? $s->student->nisn : '-' }}</td>
                            <td class="p-4 font-bold text-primary">{{ $s->name }}</td>
                            <td class="p-4 font-mono text-on-surface-variant">{{ $s->username }}</td>
                            <td class="p-4 text-center">{{ $s->student ? $s->student->class_name : 'VI C' }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ ($s->student && $s->student->gender === 'L') ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $s->student ? $s->student->gender : '-' }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <button type="button" onclick="openEditModal({{ json_encode($s) }}, {{ json_encode($s->student) }})" 
                                            class="p-1.5 bg-secondary/10 hover:bg-secondary/20 text-secondary rounded-lg transition-colors" title="Edit Data">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                    </button>
                                    <form action="{{ route('admin.students.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors" title="Hapus Siswa">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-on-surface-variant text-sm">Tidak ditemukan data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>

<!-- Modal Add / Edit Siswa -->
<div id="studentModal" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="content-card max-w-lg w-full p-6 md:p-8 rounded-2xl shadow-xl space-y-5 bg-white relative animate-in fade-in">
        <div class="flex items-center justify-between border-b border-outline-variant/30 pb-3">
            <h3 class="text-lg font-bold text-primary font-headline" id="modalTitle">Tambah Siswa Baru</h3>
            <button type="button" onclick="closeModal()" class="text-on-surface-variant hover:text-red-600">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <form id="studentForm" method="POST" action="{{ route('admin.students.store') }}" class="space-y-4">
            @csrf
            <div id="methodContainer"></div>

            <div>
                <label for="name" class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Nama Lengkap Siswa</label>
                <input type="text" name="name" id="modalName" required 
                       class="w-full px-3.5 py-2.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="nisn" class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">NISN (10 Digit)</label>
                    <input type="text" name="nisn" id="modalNisn" required 
                           class="w-full px-3.5 py-2.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary font-mono">
                </div>
                <div>
                    <label for="username" class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Username Login</label>
                    <input type="text" name="username" id="modalUsername" required 
                           class="w-full px-3.5 py-2.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary font-mono">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="class_name" class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Kelas</label>
                    <input type="text" name="class_name" id="modalClass" value="VI C" required 
                           class="w-full px-3.5 py-2.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary">
                </div>
                <div>
                    <label for="gender" class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">Jenis Kelamin</label>
                    <select name="gender" id="modalGender" required 
                            class="w-full px-3.5 py-2.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary">
                        <option value="L">Laki-laki (L)</option>
                        <option value="P">Perempuan (P)</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-on-surface-variant mb-1 uppercase tracking-wider">
                    Password <span id="passwordHelp" class="font-normal text-[11px] text-gray-500">(Minimal 4 karakter)</span>
                </label>
                <input type="password" name="password" id="modalPassword" 
                       class="w-full px-3.5 py-2.5 bg-surface-container-low border border-outline-variant/60 rounded-xl text-xs md:text-sm focus:outline-none focus:border-secondary" placeholder="Masukkan password">
            </div>

            <div class="pt-3 flex justify-end gap-2 border-t border-outline-variant/30">
                <button type="button" onclick="closeModal()" class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-xl text-xs font-bold hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 bg-secondary text-white rounded-xl text-xs font-bold nav-btn-shadow hover:brightness-105">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('studentModal');
    const form = document.getElementById('studentForm');
    const modalTitle = document.getElementById('modalTitle');
    const methodContainer = document.getElementById('methodContainer');
    const passwordHelp = document.getElementById('passwordHelp');

    function openAddModal() {
        modalTitle.innerText = 'Tambah Siswa Baru';
        form.action = "{{ route('admin.students.store') }}";
        methodContainer.innerHTML = '';
        form.reset();
        document.getElementById('modalPassword').required = true;
        passwordHelp.innerText = '(Minimal 4 karakter)';
        modal.classList.remove('hidden');
    }

    function openEditModal(user, student) {
        modalTitle.innerText = 'Edit Data Siswa: ' + user.name;
        form.action = `/guru/siswa/${user.id}`;
        methodContainer.innerHTML = '@method("PUT")';
        document.getElementById('modalName').value = user.name;
        document.getElementById('modalUsername').value = user.username;
        document.getElementById('modalNisn').value = student ? student.nisn : '';
        document.getElementById('modalClass').value = student ? student.class_name : 'VI C';
        document.getElementById('modalGender').value = student ? student.gender : 'L';
        document.getElementById('modalPassword').required = false;
        passwordHelp.innerText = '(Kosongkan jika tidak ingin mengubah password)';
        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
    }
</script>
@endsection
