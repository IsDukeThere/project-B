@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Selamat Pagi, Admin 👋</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Ringkasan operasional daur ulang dan status per hari ini</p>
        </div>
        <a href="{{ route('admin.deposits.index') }}" class="bg-amber-100 border border-amber-300 text-amber-900 px-4 py-2 rounded-2xl text-xs font-bold flex items-center gap-2 hover:bg-amber-200 transition">
            <span>🔔</span> 7 Setoran Perlu Diverifikasi
        </a>
    </div>

    <!-- 4 Statistic Cards Horizontal across Desktop -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="pb-card p-5 space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase">Setoran Menunggu</span>
            <p class="text-2xl sm:text-3xl font-black text-amber-600">7</p>
            <a href="{{ route('admin.deposits.index') }}" class="text-xs font-bold text-amber-800 hover:underline pt-1 block">Verifikasi Sekarang →</a>
        </div>

        <div class="pb-card p-5 space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase">Produk Aktif</span>
            <p class="text-2xl sm:text-3xl font-black text-slate-900">24</p>
            <span class="text-xs text-slate-500">3 stok menipis</span>
        </div>

        <div class="pb-card p-5 space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase">Workshop Terjadwal</span>
            <p class="text-2xl sm:text-3xl font-black text-slate-900">2</p>
            <a href="{{ route('admin.workshops.create') }}" class="text-xs font-bold text-emerald-700 hover:underline pt-1 block">Kelola Acara →</a>
        </div>

        <div class="pb-card p-5 space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase">Sertifikat Terbit</span>
            <p class="text-2xl sm:text-3xl font-black text-slate-900">36</p>
            <a href="{{ route('admin.certificates.create') }}" class="text-xs font-bold text-emerald-700 hover:underline pt-1 block">Lihat Sertifikat →</a>
        </div>
    </div>

    <!-- 2 Columns: Setoran Masuk Feed & Konfigurasi Nilai Tukar -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-7 pb-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <span class="text-xl">♻️</span>
                    <h2 class="font-extrabold text-base text-slate-900">Setoran Masuk Terbaru</h2>
                </div>
                <a href="{{ route('admin.deposits') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800">
                    Lihat Semua (7) →
                </a>
            </div>

            <div class="space-y-3">
                <div class="p-3.5 bg-slate-50 rounded-2xl flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white font-bold text-xs flex items-center justify-center text-slate-700 border border-slate-200">
                            RN
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">Rina Wulandari • Kemasan Multilayer</h4>
                            <p class="text-[11px] text-slate-400">2,5 kg • 2 Okt • Drop Langsung</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.deposits') }}" class="px-3.5 py-1.5 rounded-lg bg-emerald-700 text-white text-xs font-bold">
                        Timbang
                    </a>
                </div>

                <div class="p-3.5 bg-slate-50 rounded-2xl flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white font-bold text-xs flex items-center justify-center text-slate-700 border border-slate-200">
                            BM
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">Budi Mulia • Kemasan Multilayer</h4>
                            <p class="text-[11px] text-slate-400">5,0 kg • 2 Okt • Via Kurir</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.deposits') }}" class="px-3.5 py-1.5 rounded-lg bg-emerald-700 text-white text-xs font-bold">
                        Timbang
                    </a>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 pb-card p-6 space-y-5">
            <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                <span class="text-xl">⚙️</span>
                <h2 class="font-extrabold text-base text-slate-900">Konfigurasi Nilai Tukar Poin</h2>
            </div>

            <div class="grid grid-cols-3 text-center py-2 bg-slate-50 rounded-2xl border border-slate-100">
                <div>
                    <span class="text-lg font-bold text-slate-900">10</span>
                    <span class="text-[10px] text-slate-500 block">Multilayer /kg</span>
                </div>
                <div>
                    <span class="text-lg font-bold text-slate-900">10</span>
                    <span class="text-[10px] text-slate-500 block">Jelantah /L</span>
                </div>
                <div>
                    <span class="text-lg font-bold text-slate-900">Bulanan</span>
                    <span class="text-[10px] text-slate-500 block">Periode</span>
                </div>
            </div>

            <a href="{{ route('admin.points-config') }}" class="pb-btn-dark w-full py-3 text-xs text-center block">
                Ubah Parameter Poin & Periode
            </a>
        </div>
    </div>
</div>
@endsection
