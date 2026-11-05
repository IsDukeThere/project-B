@extends('layouts.app')

@section('title', 'Events & Workshop')

@section('content')
<div class="space-y-8">
    <div class="pb-hero-banner">
        <div class="max-w-2xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Events & Workshop</h1>
            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
                Belajar teknik daur ulang dan ekonomi sirkular bersama instruktur praktisi
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

       @forelse($workshops as $ws)
            <!-- KODE CARD WORKSHOP ABANG DI SINI -->
            <div class="pb-card flex flex-col justify-between space-y-4">
                <!-- (Isi card sama persis kayak yang udah kita benerin sebelumnya) -->
                <div>
                    <div class="pb-img-placeholder h-44 w-full rounded-2xl bg-emerald-100 mb-4 flex items-center justify-center overflow-hidden">
                        @if(isset($ws->image) && file_exists(public_path($ws->image)))
                            <img src="{{ asset($ws->image) }}" alt="{{ $ws->judul }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-5xl">🎓</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs px-2.5 py-1 rounded-md bg-slate-100 font-bold text-slate-700">
                            {{ \Carbon\Carbon::parse($ws->tanggal)->translatedFormat('d M Y') }}
                        </span>
                        <span class="badge-pending text-[10px]">{{ $ws->kuota }} Peserta</span>
                    </div>
                    
                    <h3 class="font-bold text-base text-slate-900 leading-snug mb-1">{{ $ws->judul }}</h3>
                    <p class="text-xs text-slate-500">{{ $ws->jam }} WIB</p>
                </div>
                
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-slate-100">
                    <span class="font-bold text-emerald-700">{{ $ws->biaya }}</span>
                    <a href="{{ $ws->registration_link ?? '#' }}" target="_blank" class="text-sm font-semibold text-slate-700 hover:text-emerald-700 transition block">
                        Daftar →
                    </a>
                </div>
            </div>
            
        @empty
            <!-- EMPTY STATE: Tampil kalau database kosong -->
            <!-- col-span-full bikin kotaknya membentang penuh ngelewatin 3 grid -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center">
                <span class="text-6xl mb-4">🪹</span>
                <h3 class="font-bold text-xl text-slate-900">Belum Ada Workshop</h3>
                <p class="text-sm text-slate-500 mt-2 max-w-md mx-auto">
                    Saat ini belum ada jadwal workshop yang tersedia. Pantau terus halaman ini untuk info kelas daur ulang berikutnya, ya!
                </p>
            </div>
        @endforelse
    </div>
</div>
@endsection
