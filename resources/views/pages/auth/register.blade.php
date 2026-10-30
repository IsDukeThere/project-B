@extends('layouts.app')

@section('title', 'Daftar Penyetor')

@section('content')
<div class="max-w-md mx-auto space-y-6 py-6">
    <div class="text-center space-y-2">
        <div class="flex items-center justify-center gap-2">
            <span class="text-3xl">♻️</span>
            <span class="font-extrabold text-2xl text-slate-900">Project B Indonesia</span>
        </div>
        <p class="text-xs text-slate-500">Daftar sebagai penyetor plastik.</p>
    </div>

    <form action="{{ route('register.process') }}" method="POST" class="pb-card p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama lengkap</label>
            <input type="text" class="pb-input" name="name" placeholder="Nama" required />
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
            <input type="text" class="pb-input" name="email" placeholder="Email" required />
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">No. HP / WhatsApp</label>
            <input type="text" class="pb-input" name="phone" placeholder="No. HP / WhatsApp" required />
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kata sandi</label>
            <input type="password" class="pb-input" name="password" placeholder="Kata Sandi" required />
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi kata sandi</label>
            <input type="password" class="pb-input" name="password_confirmation" placeholder="Ulangi Kata Sandi" required />
        </div>

        <button type="submit" class="pb-btn-dark w-full py-3">
            Daftar
        </button>
    </form>

    <div class="text-center text-xs text-slate-500">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="font-bold text-emerald-700 hover:underline">
            Masuk
        </a>
    </div>
</div>
@endsection
