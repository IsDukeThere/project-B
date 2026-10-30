@extends('layouts.depositor')

@section('title', 'Detail Setoran')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <a href="{{ route('depositor.history') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
        ← Kembali ke Riwayat Setoran
    </a>

    <div class="pb-card p-6 space-y-5 bg-white">
        <!-- Header Detail -->
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <h2 class="font-extrabold text-base text-slate-900">
                    {{ $deposit->jenis_sampah }} • {{ $deposit->berat_volume }} {{ $deposit->jenis_sampah == 'Minyak Jelantah' ? 'L' : 'kg' }}
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">
                    #STR-{{ str_pad($deposit->id, 4, '0', STR_PAD_LEFT) }} • {{ $deposit->created_at->format('d M Y') }}
                </p>
                <p class="text-[11px] text-slate-500 mt-1 font-medium bg-slate-50 inline-block px-2 py-0.5 rounded">
                    Metode: {{ $deposit->metode }}
                </p>
            </div>
            
            @if($deposit->status == 'diterima') <span class="badge-success text-xs px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-800 font-bold">Diterima</span>
            @elseif($deposit->status == 'ditolak') <span class="badge-danger text-xs px-3 py-1.5 rounded-lg bg-rose-100 text-rose-800 font-bold">Ditolak</span>
            @else <span class="badge-pending text-xs px-3 py-1.5 rounded-lg bg-amber-100 text-amber-800 font-bold">Menunggu</span>
            @endif
        </div>

        <!-- Stepper Timeline Dinamis -->
        <div class="space-y-4 pt-2 relative">
            <h3 class="font-bold text-xs text-slate-800 mb-4">Tahap Pelacakan Setoran:</h3>
            
            <!-- Garis Penghubung (Opsional, kalau CSS tailwind Abang punya styling khusus) -->
            <div class="absolute left-[11px] top-[45px] bottom-4 w-0.5 bg-slate-100 -z-10"></div>

            <div class="space-y-6">
                <!-- Tahap 1: Dikirim (Selalu Aktif) -->
                <div class="flex gap-4">
                    <div class="w-6 h-6 rounded-full bg-emerald-500 flex-shrink-0 mt-0.5 flex items-center justify-center text-white text-[10px]">✓</div>
                    <div>
                        <p class="font-bold text-xs text-slate-900">Setoran Dikirim</p>
                        <p class="text-[11px] text-slate-500">{{ $deposit->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>

                <!-- Tahap 2: Menunggu Verifikasi -->
                <div class="flex gap-4">
                    <div class="w-6 h-6 rounded-full {{ $deposit->status != 'menunggu' ? 'bg-emerald-500 text-white' : 'bg-amber-500 text-white animate-pulse' }} flex-shrink-0 mt-0.5 flex items-center justify-center text-[10px]">
                        {{ $deposit->status != 'menunggu' ? '✓' : '...' }}
                    </div>
                    <div>
                        <p class="font-bold text-xs text-slate-900">Proses Verifikasi Admin</p>
                        <p class="text-[11px] text-slate-500">
                            {{ $deposit->status != 'menunggu' ? 'Selesai diperiksa' : 'Sedang diperiksa & disiapkan untuk penimbangan' }}
                        </p>
                    </div>
                </div>

                <!-- Tahap 3: Keputusan Akhir -->
                <div class="flex gap-4">
                    <div class="w-6 h-6 rounded-full {{ $deposit->status == 'diterima' ? 'bg-emerald-500' : ($deposit->status == 'ditolak' ? 'bg-rose-500' : 'bg-slate-200') }} flex-shrink-0 mt-0.5 flex items-center justify-center text-white text-[10px]">
                        @if($deposit->status == 'diterima') ✓
                        @elseif($deposit->status == 'ditolak') ✕
                        @endif
                    </div>
                    <div>
                        <p class="font-bold text-xs text-slate-900">Diterima atau Ditolak</p>
                        <p class="text-[11px] {{ $deposit->status == 'diterima' ? 'text-emerald-600 font-bold' : ($deposit->status == 'ditolak' ? 'text-rose-600 font-bold' : 'text-slate-500') }}">
                            @if($deposit->status == 'diterima') DITERIMA pada {{ $deposit->updated_at->format('d M Y') }}
                            @elseif($deposit->status == 'ditolak') DITOLAK pada {{ $deposit->updated_at->format('d M Y') }}
                            @else Hasil verifikasi akan tampil di sini
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Tahap 4: Poin Masuk -->
                <div class="flex gap-4">
                    <div class="w-6 h-6 rounded-full {{ $deposit->status == 'diterima' ? 'bg-indigo-500' : 'bg-slate-200' }} flex-shrink-0 mt-0.5 flex items-center justify-center text-white text-[10px]">
                        ⭐
                    </div>
                    <div>
                        <p class="font-bold text-xs text-slate-900">Poin Masuk</p>
                        <p class="text-[11px] {{ $deposit->status == 'diterima' ? 'text-indigo-600 font-bold' : 'text-slate-500' }}">
                            @if($deposit->status == 'diterima') +{{ $deposit->poin_didapat }} Poin berhasil ditambahkan ke akun
                            @elseif($deposit->status == 'ditolak') Tidak ada poin yang ditambahkan
                            @else Otomatis masuk setelah setoran disetujui
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if($deposit->status == 'menunggu')
            <div class="bg-slate-50 p-4 rounded-xl text-xs text-slate-600 border border-slate-100 flex items-center gap-2">
                <span>ℹ️</span> Biasanya selesai dalam 1×24 jam kerja.
            </div>

            <!-- Tombol Batal hanya muncul kalau status masih menunggu -->
            <form action="{{ route('depositor.cancel', $deposit->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan setoran ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-3 rounded-xl text-xs font-bold text-rose-600 border-2 border-rose-100 hover:bg-rose-50 transition">
                    Batalkan Setoran
                </button>
            </form>
        @endif
    </div>
</div>
@endsection