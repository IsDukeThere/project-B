@extends('layouts.admin')
@section('title', 'Pengaturan Poin')
@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <div class="pb-card p-6 sm:p-8 space-y-6 bg-white">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Pengaturan Poin</h1>
            <p class="text-xs text-slate-500 mt-1">Konfigurasi poin per kg/liter untuk sistem setoran.</p>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 text-emerald-700 rounded-xl font-bold text-sm border border-emerald-200">✅ {{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.points.update') }}" method="POST" class="space-y-5">
            @csrf
            <div class="space-y-3">
                <h3 class="font-bold text-xs text-slate-700 uppercase">Poin per kg/L</h3>
                
                @foreach($configs as $config)
                <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                    <span class="text-xs font-bold text-slate-900">{{ $config->jenis_sampah }}</span>
                    <!-- Array input name='poin[ID]' biar nyimpennya gampang di controller -->
                    <input type="number" name="poin[{{ $config->id }}]" class="w-20 text-center font-bold pb-input py-2 text-xs" value="{{ $config->poin_per_satuan }}" min="1" required />
                </div>
                @endforeach
            </div>

            <div class="space-y-2 pt-4">
                <label class="block text-xs font-bold text-slate-700 uppercase">Periode peringkat</label>
                <div class="grid grid-cols-1">
                    <!-- Dibikin disabled karena udah paten Bulanan secara sistem -->
                    <button type="button" disabled class="py-2.5 rounded-xl text-xs font-semibold border border-slate-800 bg-slate-900 text-white font-bold opacity-70 cursor-not-allowed">
                        Bulanan (Sistem Otomatis)
                    </button>
                    <p class="text-[10px] text-slate-400 mt-2 text-center">Periode peringkat berjalan otomatis menghitung akumulasi poin dari tanggal 1 hingga akhir bulan berjalan.</p>
                </div>
            </div>

            <button type="submit" class="pb-btn-dark w-full py-3.5 mt-4">
                Simpan Pengaturan
            </button>
        </form>
    </div>
</div>
@endsection