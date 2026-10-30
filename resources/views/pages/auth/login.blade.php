@extends('layouts.app')

@section('title', 'Masuk Akun')

@section('content')
<div class="max-w-md mx-auto space-y-6 py-6">
    <div class="text-center space-y-2">
        <div class="flex items-center justify-center gap-2">
            <span class="text-3xl">♻️</span>
            <span class="font-extrabold text-2xl text-slate-900">Project B Indonesia</span>
        </div>
        <p class="text-xs text-slate-500">Masuk untuk setor plastik atau belanja produk.</p>
    </div>

    <form action="{{ route('login.process') }}" method="POST" class="pb-card p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
            @error('email')
                <p style="color: red; font-size: 14px; margin-bottom: 5px;">{{ $message }}</p>
            @enderror
            <input type="text" class="pb-input" name="email" placeholder="Email" required />
        </div>

        <div>
            <div class="flex justify-between items-center mb-1">
                <label class="block text-xs font-bold text-slate-700">Kata sandi</label>
            </div>
            @error('password')
                <p style="color: red; font-size: 14px; margin-bottom: 5px;">{{ $message }}</p>
            @enderror
            <input type="password" class="pb-input" name="password" placeholder="Password" required />
            <a href="#" class="text-xs text-slate-400 hover:text-slate-600">Lupa sandi?</a>
        </div>

        <button type="submit" class="pb-btn-primary w-full py-3">
            Masuk
        </button>

        <div class="relative flex py-2 items-center">
            <div class="flex-grow border-t border-slate-200"></div>
            <span class="flex-shrink mx-3 text-slate-400 text-xs">Atau</span>
            <div class="flex-grow border-t border-slate-200"></div>
        </div>

        <a href="{{ route('depositor.procedure') }}" class="w-full py-3 rounded-full text-xs font-semibold bg-emerald-100/70 text-emerald-800 hover:bg-emerald-200/80 transition flex items-center justify-center gap-2">
            <span>🌐</span> Masuk dengan Google
        </a>
    </form>

    <div class="text-center text-xs text-slate-500">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="font-bold text-emerald-700 hover:underline">
            Daftar Akun Baru
        </a>
    </div>
</div>
@endsection
