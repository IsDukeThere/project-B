@extends('layouts.depositor')

@section('title', 'Prosedur Penyetoran')

@section('content')
<div class="space-y-8">
    <div class="pb-card p-6 bg-gradient-to-r from-emerald-800 to-teal-800 text-white rounded-3xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-xs text-emerald-200">Halo, {{ auth()->user()->name }} 👋</p>
                <h1 class="text-xl sm:text-2xl font-black text-white mt-1">Prosedur Penyetoran Sampah</h1>
                <p class="text-xs sm:text-sm text-emerald-100 mt-1">Pilah sampah dengan bersih dan kumpulkan poin reward setiap kg.</p>
            </div>
            <a href="{{ route('depositor.form') }}" class="bg-white text-emerald-950 font-bold px-6 py-3 rounded-full text-xs hover:bg-emerald-50 transition shadow-lg self-start sm:self-auto">
                Setor Sekarang →
            </a>
        </div>
    </div>

    <!-- 2 Columns: Jenis Sampah & Kondisi Wajib -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="space-y-3">
            <h2 class="font-extrabold text-base text-slate-900">Yang Bisa Disetor</h2>
            <div class="space-y-3">
                <div class="pb-card p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl">🍜</span>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Kemasan Multilayer</h3>
                            <p class="text-xs text-slate-500 leading-snug">Bungkus mie instan, sachet minuman, detergen, minyak goreng.</p>
                        </div>
                    </div>
                    <span class="badge-success text-xs font-bold">
                        {{ $configs['Kemasan Multilayer']->poin_per_satuan ?? 10 }} poin/kg
                    </span>
                </div>

                <div class="pb-card p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl">🛢️</span>
                        <div>
                            <h3 class="font-bold text-sm text-slate-900">Minyak Jelantah</h3>
                            <p class="text-xs text-slate-500 leading-snug">Simpan di wadah tertutup rapat tanpa sisa makanan.</p>
                        </div>
                    </div>
                    <span class="badge-success text-xs font-bold">
                        {{ $configs['Minyak Jelantah']->poin_per_satuan ?? 10 }} poin/liter
                    </span>
                </div>

            </div>
        </div>

        <div class="space-y-3">
            <h2 class="font-extrabold text-base text-slate-900">Ketentuan Kualitas</h2>
            <div class="bg-amber-50 border border-amber-200 rounded-3xl p-5 space-y-2">
                <div class="flex items-center gap-2 font-bold text-xs text-amber-900">
                    <span class="text-lg">⚠️</span> Kondisi Wajib
                </div>
                <p class="text-xs text-amber-800 leading-relaxed">
                    Sampah harus dalam keadaan <strong>kosong, bersih, dan kering</strong>, tidak bercampur air atau sisa makanan hewani, serta bukan berasal dari produk non-halal.
                </p>
                <p class="text-[11px] text-amber-700/80 pt-1">
                    Kondisi yang bersih memudahkan pengrajin memproses tanpa bau dan menghasilkan kerajinan yang kuat.
                </p>
            </div>
        </div>
    </div>

    <!-- 4 Langkah & Metode Serah -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-8 space-y-4">
            <h2 class="font-extrabold text-base text-slate-900">4 Langkah Penyetoran</h2>
            <div class="pb-card p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">1</span>
                    <div>
                        <h4 class="font-bold text-xs text-slate-900">Siapkan Sampah</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Pilah per jenis dan pastikan bersih serta kering.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">2</span>
                    <div>
                        <h4 class="font-bold text-xs text-slate-900">Isi Data Setoran</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Tentukan jenis, perkiraan jumlah, dan cara serah.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">3</span>
                    <div>
                        <h4 class="font-bold text-xs text-slate-900">Serahkan</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Drop langsung ke butik atau kirim melalui kurir.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-7 h-7 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">4</span>
                    <div>
                        <h4 class="font-bold text-xs text-slate-900">Tunggu Verifikasi</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Admin menimbang dan poin otomatis masuk.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-4">
            <h2 class="font-extrabold text-base text-slate-900">Cara Menyerahkan</h2>
            <div class="pb-card p-5 space-y-3">
                <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="font-bold text-xs text-slate-900 flex items-center gap-1.5">
                        <span>🏪</span> Drop Langsung
                    </p>
                    <p class="text-xs text-slate-500 mt-1">Butik Daur Ulang, Jl. Contoh No. 12</p>
                    <p class="text-[10px] text-slate-400">Senin–Sabtu: 08.00–20.00 WIB</p>
                </div>

                <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100">
                    <p class="font-bold text-xs text-slate-900 flex items-center gap-1.5">
                        <span>🚚</span> Kirim Via Kurir
                    </p>
                    <p class="text-xs text-slate-500 mt-1">Ekspedisi ke alamat workshop Project B</p>
                    <a href="{{ route('location') }}" class="text-[11px] font-bold text-emerald-700 mt-1 block">Lihat Alamat Lengkap →</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
