@extends('layouts.app')

@section('title', 'Alur Proses Produksi')

@section('content')
<div class="space-y-8">
    <div class="pb-hero-banner">
        <div class="max-w-2xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Alur Proses Produksi</h1>
            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
                Lihat langsung bagaimana sampah plastik berubah jadi karya bernilai tinggi melalui 5 tahapan sirkular yang terukur.
            </p>
        </div>
    </div>

    <!-- Video Placeholder -->
    <div class="pb-card overflow-hidden bg-emerald-50 border-emerald-200 rounded-2xl shadow-sm max-w-4xl mx-auto">

            <div class="w-full bg-black">
                <video controls class="w-full aspect-video object-contain">
                    <source src="{{ asset('vid/Kompro.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video.
                </video>
            </div>
    </div>

    <!-- 5 Tahap Pengolahan (Responsive Grid) -->
    <div>
        <h2 class="font-extrabold text-xl text-slate-900 mb-6">5 Tahap Pengolahan Sirkular</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="pb-card flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-8 h-8 rounded-full bg-emerald-700 text-white font-extrabold text-sm flex items-center justify-center">1</span>
                        <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full">± 1 hari</span>
                    </div>
                    <div class="pb-img-placeholder h-36 w-full rounded-2xl bg-emerald-100 text-3xl mb-4">
                        📦
                        <span class="text-xs font-semibold text-emerald-900 mt-2">Foto: Pengumpulan Sampah</span>
                    </div>
                    <h3 class="font-bold text-base text-slate-900 mb-1.5">Pengumpulan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Sampah plastik diterima dari warga, bank sampah, dan mitra drop-point terverifikasi.</p>
                </div>
                <div class="pt-3 border-t border-slate-100 text-xs text-slate-500">Stasiun: <strong>Drop Point</strong></div>
            </div>

            <div class="pb-card flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-8 h-8 rounded-full bg-emerald-700 text-white font-extrabold text-sm flex items-center justify-center">2</span>
                        <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full">± 1 hari</span>
                    </div>
                    <div class="pb-img-placeholder h-36 w-full rounded-2xl bg-emerald-100 text-3xl mb-4">
                        🔍
                        <span class="text-xs font-semibold text-emerald-900 mt-2">Foto: Pemilahan Jenis Plastik</span>
                    </div>
                    <h3 class="font-bold text-base text-slate-900 mb-1.5">Pemilahan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Dipisah berdasarkan jenis: kemasan multilayer, PET, HDPE, dan PP serta dibersihkan.</p>
                </div>
                <div class="pt-3 border-t border-slate-100 text-xs text-slate-500">Stasiun: <strong>Tim Sortir</strong></div>
            </div>

            <div class="pb-card flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-8 h-8 rounded-full bg-emerald-700 text-white font-extrabold text-sm flex items-center justify-center">3</span>
                        <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full">± 2 hari</span>
                    </div>
                    <div class="pb-img-placeholder h-36 w-full rounded-2xl bg-emerald-100 text-3xl mb-4">
                        ⚙️
                        <span class="text-xs font-semibold text-emerald-900 mt-2">Foto: Pencucian & Pencacahan</span>
                    </div>
                    <h3 class="font-bold text-base text-slate-900 mb-1.5">Pembersihan & Pencacahan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Dicuci dengan air ramah lingkungan, dikeringkan secara higienis, lalu dicacah.</p>
                </div>
                <div class="pt-3 border-t border-slate-100 text-xs text-slate-500">Stasiun: <strong>Mesin Cacah</strong></div>
            </div>

            <div class="pb-card flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-8 h-8 rounded-full bg-emerald-700 text-white font-extrabold text-sm flex items-center justify-center">4</span>
                        <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full">± 3 hari</span>
                    </div>
                    <div class="pb-img-placeholder h-36 w-full rounded-2xl bg-emerald-100 text-3xl mb-4">
                        🧵
                        <span class="text-xs font-semibold text-emerald-900 mt-2">Foto: Pengepresan / Anyaman</span>
                    </div>
                    <h3 class="font-bold text-base text-slate-900 mb-1.5">Pengolahan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Dipres menggunakan suhu terukur atau dianyam menjadi lembaran kain sintetis.</p>
                </div>
                <div class="pt-3 border-t border-slate-100 text-xs text-slate-500">Stasiun: <strong>Produksi</strong></div>
            </div>

            <div class="pb-card flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-8 h-8 rounded-full bg-emerald-700 text-white font-extrabold text-sm flex items-center justify-center">5</span>
                        <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full">Siap Jual</span>
                    </div>
                    <div class="pb-img-placeholder h-36 w-full rounded-2xl bg-emerald-100 text-3xl mb-4">
                        ✨
                        <span class="text-xs font-semibold text-emerald-900 mt-2">Foto: Produk Jadi</span>
                    </div>
                    <h3 class="font-bold text-base text-slate-900 mb-1.5">Produk Jadi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Dijahit oleh pengrajin lokal dengan quality control teliti, lalu dikemas.</p>
                </div>
                <div class="pt-3 border-t border-slate-100 text-xs text-slate-500">Stasiun: <strong>QC Butik</strong></div>
            </div>
        </div>
    </div>
</div>
@endsection
