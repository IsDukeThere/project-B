@extends('layouts.admin')
@section('title', 'Verifikasi Setoran')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Verifikasi Data Setoran</h1>
            <p class="text-xs text-slate-500 mt-1">Timbang ulang dan verifikasi sampah yang diserahkan warga</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 rounded-xl font-bold text-sm border border-emerald-200">✅ {{ session('success') }}</div>
    @endif

    <!-- Desktop Wide Table -->
    <div class="pb-card p-0 overflow-hidden bg-white overflow-x-auto">
        <table class="w-full text-left text-xs min-w-[800px]">
            <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-100">
                <tr>
                    <th class="py-3.5 px-6">ID & Penyetor</th>
                    <th class="py-3.5 px-6">Jenis Sampah</th>
                    <th class="py-3.5 px-6">Berat / Vol</th>
                    <th class="py-3.5 px-6">Metode & Catatan</th>
                    <th class="py-3.5 px-6">Tanggal</th>
                    <th class="py-3.5 px-6">Status</th>
                    <th class="py-3.5 px-6 text-right">Tindakan Verifikasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($deposits as $d)
                <tr class="hover:bg-slate-50 transition">
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 font-bold text-xs flex items-center justify-center text-slate-700">
                                {{ strtoupper(substr($d->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">{{ $d->user->name }}</span>
                                <span class="text-[11px] text-slate-400">#STR-{{ str_pad($d->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 font-semibold">{{ $d->jenis_sampah }}</td>
                    <td class="py-4 px-6 font-bold text-slate-800">{{ $d->berat_volume }} {{ $d->jenis_sampah == 'Minyak Jelantah' ? 'L' : 'kg' }}</td>
                    <td class="py-4 px-6 text-slate-500">
                        {{ $d->metode }}
                        @if($d->catatan) <br><span class="text-[10px] text-slate-400 italic">"{{ $d->catatan }}"</span> @endif
                    </td>
                    <td class="py-4 px-6 text-slate-500">{{ $d->created_at->format('d M Y') }}</td>
                    <td class="py-4 px-6">
                        @if($d->status == 'diterima') <span class="bg-emerald-100 text-emerald-800 font-bold px-2 py-1 rounded">Diterima</span>
                        @elseif($d->status == 'ditolak') <span class="bg-rose-100 text-rose-800 font-bold px-2 py-1 rounded">Ditolak</span>
                        @else <span class="bg-amber-100 text-amber-800 font-bold px-2 py-1 rounded">Menunggu</span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right">
                        @if($d->status == 'menunggu')
                        <div class="inline-flex gap-2 justify-end">
                            <form action="{{ route('admin.deposits.verify', $d->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="terima">
                                <button type="submit" class="px-3.5 py-1.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white font-bold transition">
                                    Terima (Setujui Poin)
                                </button>
                            </form>
                            <form action="{{ route('admin.deposits.verify', $d->id) }}" method="POST" onsubmit="return confirm('Tolak setoran ini?');">
                                @csrf
                                <input type="hidden" name="action" value="tolak">
                                <button type="submit" class="px-3.5 py-1.5 rounded-lg border border-slate-300 hover:text-rose-600 font-bold transition">
                                    Tolak
                                </button>
                            </form>
                        </div>
                        @else
                        <span class="text-slate-400 text-xs font-semibold italic">Telah Diverifikasi</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="py-8 text-center text-slate-500 font-medium">Tidak ada data setoran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection