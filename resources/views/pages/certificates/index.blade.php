@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="space-y-10">
    <div class="pb-hero-banner">
        <div class="max-w-2xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Penghargaan & Pengakuan</h1>
            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
                Dipercaya instansi, sekolah, komunitas, dan ratusan warga yang berkontribusi nyata mengurangi timbulan sampah.
            </p>
        </div>
    </div>

    <!-- 2 Columns: Penghargaan vs Kepercayaan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-4">
            <h2 class="font-extrabold text-lg text-slate-900">Semua Penghargaan yang Diterima</h2>
            
            <div class="space-y-3">
                @forelse($certificates as $certificate)
                    <div class="pb-card flex items-center justify-between p-4 bg-white rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-2xl flex-shrink-0">
                                🏆
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-slate-900">{{ $certificate->nama }}</h3>
                                <p class="text-xs text-slate-500">{{ $certificate->penyelenggara }} · {{ $certificate->tahun }}</p>
                            </div>
                        </div>
                        <a href="{{ route('certificates.show', $certificate->id) }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition">
                            Lihat Dokumen ›
                        </a>
                    </div>
                @empty
                    <div class="text-center py-10 bg-white rounded-2xl border border-dashed border-slate-300">
                        <span class="text-4xl block mb-2">📜</span>
                        <p class="text-sm text-slate-500 font-medium">Belum ada penghargaan yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="font-extrabold text-lg text-slate-900">Kenapa Percaya Kami?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div class="pb-card p-4 space-y-2">
                    <span class="text-2xl">📄</span>
                    <h3 class="font-bold text-xs text-slate-900">Legalitas Usaha Resmi</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">NIB & izin edar usaha lengkap terverifikasi pemerintah.</p>
                </div>
                <div class="pb-card p-4 space-y-2">
                    <span class="text-2xl">🔍</span>
                    <h3 class="font-bold text-xs text-slate-900">Proses Transparan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Dokumentasi foto & video tiap tahap pengolahan terbuka untuk umum.</p>
                </div>
                <div class="pb-card p-4 space-y-2">
                    <span class="text-2xl">📊</span>
                    <h3 class="font-bold text-xs text-slate-900">Laporan Dampak Bulanan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Statistik kilogram sampah terolah dipublikasikan setiap akhir bulan.</p>
                </div>
                <div class="pb-card p-4 space-y-2">
                    <span class="text-2xl">🛡️</span>
                    <h3 class="font-bold text-xs text-slate-900">Garansi & Kontrol Mutu</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Retur 7 hari jika ditemukan cacat produksi jahitan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
