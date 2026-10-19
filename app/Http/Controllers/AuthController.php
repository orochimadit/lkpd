<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->isGuru()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('student.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->isGuru()) {
                return redirect()->intended(route('admin.dashboard'));
            }
            return redirect()->intended(route('student.dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    public function quickLogin(string $role)
    {
        $user = null;
        if ($role === 'guru') {
            $user = User::where('role', 'guru')->first();
        } elseif ($role === 'siswa') {
            $user = User::where('role', 'siswa')->first();
        }

        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();

            if ($user->isGuru()) {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil masuk sebagai Guru / Peneliti.');
            }
            return redirect()->route('student.dashboard')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        return redirect()->route('login')->with('error', 'Akun demo tidak ditemukan.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
