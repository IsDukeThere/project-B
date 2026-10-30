<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        // 1. Validasi inputan form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek kecocokan email & password di database
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // 3. CEK ROLE
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('depositor.procedure');
            }
        }

        // 4. Kalau password salah, balikin ke halaman login bawa pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function register_process(Request $request)
    {
        // 1. Validasi inputan form (termasuk ngecek konfirmasi password)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:30'],
            'password' => ['required', 'min:8', 'confirmed'], // 'confirmed' akan otomatis ngecek input 'password_confirmation'
        ]);

        // 2. Simpan user baru ke database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']), // Acak password pakai Bcrypt
            'role' => 'customer', // Otomatis jadikan sebagai pelanggan
        ]);

        // 3. Langsung loginkan user yang baru daftar
        Auth::login($user);

        // 4. Lempar ke dashboard pelanggan
        return redirect()->route('depositor.procedure');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}