@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-12">
    <!-- Hero Banner (2-Column Fluid on Desktop) -->
    <div class="pb-hero-banner">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-7 space-y-5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-800/60 border border-emerald-400/30 text-emerald-200 text-xs font-semibold">
                    <span>🌱</span> Gerakan Daur Ulang Mandiri
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight">
                    Sampah Bukan Akhir, Tapi Awal Sebuah Karya
                </h1>
                <p class="text-emerald-100 text-sm sm:text-base leading-relaxed max-w-xl">
                    Setiap sampah yang terkumpul memiliki kesempatan untuk memiliki kehidupan kedua. Melalui proses kreatif di workshop kami, sampah plastik diolah menjadi berbagai produk yang dapat digunakan kembali.
                </p>
                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="{{ route('depositor.procedure') }}" class="bg-white text-emerald-950 font-bold px-6 py-3 rounded-full text-sm hover:bg-emerald-50 transition shadow-lg">
                        Mulai Setor Sampah →
                    </a>
                    <a href="{{ route('production-process') }}" class="bg-emerald-900/40 border border-emerald-400/40 text-white font-semibold px-5 py-3 rounded-full text-sm hover:bg-emerald-800/60 transition">
                        Lihat Alur Proses
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 sm:p-7 text-white space-y-5 shadow-2xl">
                    <div class="flex items-center justify-between border-b border-white/15 pb-4">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-emerald-200 font-bold">Dampak Nyata</p>
                            <h3 class="text-lg font-bold text-white">Sirkularitas Project B</h3>
                        </div>
                        <span class="text-3xl">♻️</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="bg-black/20 p-3.5 rounded-2xl">
                            <span class="text-2xl font-black text-white block">983.002++</span>
                            <span class="text-xs text-emerald-200">Sampah Sachet Terolah</span>
                        </div>
                        <div class="bg-black/20 p-3.5 rounded-2xl">
                            <span class="text-2xl font-black text-white block">11500++</span>
                            <span class="text-xs text-emerald-200">Penyetor Aktif</span>
                        </div>
                        <div class="bg-black/20 p-3.5 rounded-2xl">
                            <span class="text-2xl font-black text-white block">12</span>
                            <span class="text-xs text-emerald-200">Pekerja Lokal</span>
                        </div>
                        <div class="bg-black/20 p-3.5 rounded-2xl">
                            <span class="text-2xl font-black text-white block">{{ $poinMultilayer}} Poin</span>
                            <span class="text-xs text-emerald-200">Per kg Sampah</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('depositor.procedure') }}" class="pb-card pb-card-interactive flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-3xl flex-shrink-0">
                🍜
            </div>
            <div>
                <h3 class="font-bold text-base text-slate-900">Panduan Penyetoran Sampah</h3>
                <p class="text-xs text-slate-500 mt-1">Kemasan multilayer sachet & minyak jelantah dapat ditukar poin reward.</p>
                <span class="text-xs font-bold text-emerald-700 mt-2 inline-block">Baca Prosedur Lengkap →</span>
            </div>
        </a>

        <a href="{{ route('certificates.index') }}" class="pb-card pb-card-interactive flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center text-3xl flex-shrink-0">
                🏆
            </div>
            <div>
                <h3 class="font-bold text-base text-slate-900">Pencapaian & Kredibilitas</h3>
                <p class="text-xs text-slate-500 mt-1">Penghargaan UMKM Hijau Terbaik dari Dinas Lingkungan Hidup 2026.</p>
                <span class="text-xs font-bold text-amber-800 mt-2 inline-block">Lihat Sertifikasi & Testimoni →</span>
            </div>
        </a>
    </div>

    <!-- Produk Unggulan -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-900">Produk Unggulan</h2>
                <p class="text-xs sm:text-sm text-slate-500">Hasil daur ulang kemasan sachet plastik bernilai fungsional</p>
            </div>
            <a href="{{ route('products.index') }}" class="text-xs sm:text-sm font-bold text-emerald-700 hover:text-emerald-800">
                Semua Produk →
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($products as $prod)
                <div class="pb-card flex flex-col justify-between p-4 bg-white border border-slate-200 rounded-2xl shadow-sm">
                    <div>
                        <!-- Gambar / Placeholder Produk -->
                        <div class="pb-img-placeholder h-40 sm:h-48 w-full mb-3 rounded-xl bg-slate-100 flex items-center justify-center text-5xl overflow-hidden">
                            @if(isset($prod->image) && file_exists(public_path($prod->image)))
                                <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" class="w-full h-full object-contain p-2">
                            @else
                                <span>🛍️</span>
                            @endif
                        </div>

                        <span class="text-[10px] sm:text-[11px] font-semibold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full inline-block mb-1.5">
                            {{ $prod->category ?? 'Produk Unggulan' }}
                        </span>

                        <h3 class="font-bold text-sm text-slate-900 line-clamp-1 mb-1">{{ $prod->name }}</h3>
                        <p class="text-xs text-slate-500 line-clamp-2 mb-3 leading-relaxed">{{ $prod->description }}</p>
                    </div>

                    <!-- Bagian Bawah: Tombol Beli / Link E-commerce & Detail -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                        <!-- Tombol Link E-commerce langsung -->
                        @if(!empty($prod->link))
                            <a href="{{ $prod->link }}" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 hover:underline">
                                Beli Sekarang ›
                            </a>
                        @else
                            <span class="text-xs text-slate-400 font-medium">Segera Hadir</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
