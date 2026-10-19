<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'siswa')->with('student');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhereHas('student', function ($sq) use ($search) {
                      $sq->where('nisn', 'like', "%{$search}%");
                  });
            });
        }

        $students = $query->latest()->get();

        return view('admin.students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'nisn' => 'required|string|max:20|unique:students,nisn',
            'gender' => 'required|in:L,P',
            'class_name' => 'required|string|max:20',
            'password' => 'required|string|min:4',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->username . '@siswa.sdn21.sch.id',
            'role' => 'siswa',
            'password' => Hash::make($request->password),
        ]);

        Student::create([
            'user_id' => $user->id,
            'nisn' => $request->nisn,
            'class_name' => $request->class_name,
            'school_name' => 'SD Negeri 21 Pontianak Barat',
            'gender' => $request->gender,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $user = User::where('role', 'siswa')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'nisn' => 'required|string|max:20|unique:students,nisn,' . ($user->student ? $user->student->id : 0),
            'gender' => 'required|in:L,P',
            'class_name' => 'required|string|max:20',
            'password' => 'nullable|string|min:4',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($user->student) {
            $user->student->update([
                'nisn' => $request->nisn,
                'class_name' => $request->class_name,
                'gender' => $request->gender,
            ]);
        }

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $user = User::where('role', 'siswa')->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
