@extends('layouts.depositor')
@section('title', 'Riwayat Setoran')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-extrabold text-2xl sm:text-3xl text-slate-900">Riwayat Setoran</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Daftar pengajuan dan status verifikasi setoran Anda</p>
        </div>
        <a href="{{ route('depositor.form') }}" class="pb-btn-primary self-start sm:self-auto text-xs py-2.5">
            + Ajukan Setoran Baru
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 rounded-xl font-bold text-sm border border-emerald-200">✅ {{ session('success') }}</div>
    @endif

    <!-- Desktop Wide Table -->
    <div class="hidden md:block pb-card p-0 overflow-hidden">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-100">
                <tr>
                    <th class="py-3.5 px-6">ID Setoran</th>
                    <th class="py-3.5 px-6">Jenis Sampah</th>
                    <th class="py-3.5 px-6">Jumlah</th>
                    <th class="py-3.5 px-6">Tanggal</th>
                    <th class="py-3.5 px-6">Metode</th>
                    <th class="py-3.5 px-6">Status</th>
                    <th class="py-3.5 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($deposits as $d)
                <tr class="hover:bg-slate-50 transition">
                    <td class="py-3.5 px-6 font-bold text-slate-900">#STR-{{ str_pad($d->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="py-3.5 px-6 font-semibold">{{ $d->jenis_sampah }}</td>
                    <td class="py-3.5 px-6 font-bold text-slate-800">{{ $d->berat_volume }} {{ $d->jenis_sampah == 'Minyak Jelantah' ? 'L' : 'kg' }}</td>
                    <td class="py-3.5 px-6 text-slate-500">{{ $d->created_at->format('d M Y') }}</td>
                    <td class="py-3.5 px-6 text-slate-500">{{ $d->metode }}</td>
                    <td class="py-3.5 px-6">
                        @if($d->status == 'diterima') <span class="badge-success text-[10px] px-2 py-1 rounded bg-emerald-100 text-emerald-800 font-bold">Diterima</span>
                        @elseif($d->status == 'ditolak') <span class="badge-danger text-[10px] px-2 py-1 rounded bg-rose-100 text-rose-800 font-bold">Ditolak</span>
                        @else <span class="badge-pending text-[10px] px-2 py-1 rounded bg-amber-100 text-amber-800 font-bold">Menunggu</span>
                        @endif
                    </td>
                    <td class="py-3.5 px-6 text-right">
                        <a href="{{ route('depositor.detail', $d->id) }}" class="font-bold text-emerald-700 hover:text-emerald-800">Detail ›</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="py-8 text-center text-slate-500 font-medium">Belum ada riwayat setoran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card Feed -->
    <div class="md:hidden space-y-3">
        @forelse($deposits as $d)
        <a href="{{ route('depositor.detail', $d->id) }}" class="pb-card p-4 space-y-2 block">
            <div class="flex items-center justify-between">
                <span class="font-bold text-xs text-slate-900">{{ $d->jenis_sampah }} • {{ $d->berat_volume }} {{ $d->jenis_sampah == 'Minyak Jelantah' ? 'L' : 'kg' }}</span>
                @if($d->status == 'diterima') <span class="badge-success text-[10px] px-2 py-1 rounded bg-emerald-100 text-emerald-800 font-bold">Diterima</span>
                @elseif($d->status == 'ditolak') <span class="badge-danger text-[10px] px-2 py-1 rounded bg-rose-100 text-rose-800 font-bold">Ditolak</span>
                @else <span class="badge-pending text-[10px] px-2 py-1 rounded bg-amber-100 text-amber-800 font-bold">Menunggu</span>
                @endif
            </div>
            <p class="text-[11px] text-slate-400">#STR-{{ str_pad($d->id, 4, '0', STR_PAD_LEFT) }} • {{ $d->created_at->format('d M Y') }}</p>
        </a>
        @empty
        <div class="pb-card p-6 text-center text-xs text-slate-500">Belum ada riwayat setoran.</div>
        @endforelse
    </div>
</div>
@endsection