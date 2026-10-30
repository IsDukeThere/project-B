@extends('layouts.app')

@section('title', 'Detail Sertifikat')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <a href="{{ route('certificates.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
        ← Kembali ke Daftar Penghargaan
    </a>

    <!-- Big Green-Blue Certificate Banner (Wireframe Hal 31) -->
    <div class="relative w-full rounded-3xl overflow-hidden text-white shadow-xl bg-slate-900">

        @if($certificate->image)
            <img src="{{ asset($certificate->image) }}" alt="{{ $certificate->nama }}" class="w-full h-auto block">
            <div class="absolute inset-0 bg-slate-900/60 pointer-events-none"></div>
        @else
            <div class="w-full aspect-[4/3] sm:aspect-[21/9]" style="background: linear-gradient(135deg, #0d3b66 0%, #006466 50%, #06d6a0 100%);"></div>
        @endif

        <div class="absolute inset-0 p-5 sm:p-8 flex flex-col justify-between z-10 pointer-events-none">
            <!-- Bagian Atas -->
            <div class="flex justify-between items-start">
                <span class="text-3xl sm:text-4xl drop-shadow-md">📜</span>
                <span class="bg-white/20 backdrop-blur-md px-3.5 py-1 rounded-full text-xs font-semibold shadow-sm">Tahun {{ $certificate->tahun }}</span>
            </div>

            <div>
                <p class="text-[10px] sm:text-xs uppercase tracking-widest text-emerald-300 font-extrabold mb-1 drop-shadow-md">
                    {{ $certificate->penyelenggara }}
                </p>
                <h2 class="text-xl sm:text-3xl font-extrabold drop-shadow-lg leading-tight">
                    {{ $certificate->nama }}
                </h2>
            </div>
        </div>
        
    </div>

    <div class="pb-card p-6 space-y-4">
        <h1 class="text-xl font-bold text-slate-900">{{ $certificate->nama }}</h1>
        <p class="text-xs font-semibold text-slate-500">{{ $certificate->penyelenggara }} · Diterbitkan {{ $certificate->tahun }}</p>
        <p class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-200">
            {{ $certificate->penjelasan }}
        </p>
    </div>
</div>
@endsection
