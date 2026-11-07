@extends('layouts.depositor')

@section('title', 'Profil Penyetor')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <h1 class="text-2xl font-extrabold text-slate-900">Profil Penyetor</h1>

    <div class="pb-card p-6 text-center space-y-3">
        <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-2xl flex items-center justify-center mx-auto shadow-sm">
            {{ auth()->user()->initials }}
        </div>
        <div>
            <h2 class="font-extrabold text-lg text-slate-900">{{ auth()->user()->name }}</h2>
            <p class="text-xs text-slate-400">Penyetor aktif sejak {{ auth()->user()->created_at->translatedFormat('F Y') }}</p>
        </div>
    </div>

    <div class="pb-card p-5 grid grid-cols-3 divide-x divide-slate-100 text-center">
        <div>
            <!-- Total berat sampah bulan ini -->
            <span class="text-xl font-bold text-slate-900 block">
                {{ number_format($totalBeratBulanIni, 1, ',', '.') }}
            </span>
            <span class="text-xs text-slate-400">kg bulan ini</span>
        </div>
        <div>
            <!-- Peringkat bulanan user -->
            <span class="text-xl font-bold text-slate-900 block">
                #{{ $peringkat }}
            </span>
            <span class="text-xs text-slate-400">peringkat</span>
        </div>
        <div>
            <!-- Total kumulatif poin yang didapat -->
            <span class="text-xl font-bold text-slate-900 block">
                {{ $totalPoin }}
            </span>
            <span class="text-xs text-slate-400">total poin</span>
        </div>
    </div>

    <div class="pb-card p-0 overflow-hidden divide-y divide-slate-100">
        <div class="p-4 flex items-center justify-between">
            <span class="text-xs sm:text-sm font-semibold text-slate-800 flex items-center gap-3">
                <span>📱</span> WhatsApp: {{ auth()->user()->phone }}
            </span>
        </div>
        <div class="p-4 flex items-center justify-between">
            <span class="text-xs sm:text-sm font-semibold text-slate-800 flex items-center gap-3">
                <span>✉️</span> Email: {{ auth()->user()->email }}
            </span>
        </div>
    </div>
</div>
@endsection
