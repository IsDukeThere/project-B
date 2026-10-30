@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="space-y-6">
    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
        ← Kembali ke Katalog Produk
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Showcase Foto -->
        <div class="lg:col-span-6">
            <div class="pb-img-placeholder h-72 sm:h-96 w-full rounded-3xl bg-emerald-100 text-7xl shadow-inner">
                👜
            </div>
        </div>

        <!-- Spesifikasi & Pemesanan -->
        <div class="lg:col-span-6 space-y-6">
            <div>
                <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-wider">
                    Pencil Case & Bag Edition
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Tas Totebag Anyaman</h1>
                <p class="text-2xl font-black text-emerald-800 mt-2">Rp85.000</p>
                <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                    Dibuat dari anyaman plastik daur ulang kemasan sachet kopi dan mie instan. Sangat kuat, tahan air, dan tiap tas memiliki motif warna unik hasil perpaduan alami kemasan daur ulang.
                </p>
            </div>

            <!-- Specs Table Card -->
            <div class="pb-card p-5 space-y-3 bg-white">
                <div class="flex justify-between text-xs py-1.5 border-b border-slate-100">
                    <span class="text-slate-500">Material Bahan</span>
                    <span class="font-bold text-slate-800">PET & LDPE Multilayer</span>
                </div>
                <div class="flex justify-between text-xs py-1.5 border-b border-slate-100">
                    <span class="text-slate-500">Dimensi Ukuran</span>
                    <span class="font-bold text-slate-800">38 × 32 cm</span>
                </div>
                <div class="flex justify-between text-xs py-1.5">
                    <span class="text-slate-500">Ketersediaan Stok</span>
                    <span class="font-bold text-emerald-700">14 unit siap kirim</span>
                </div>
            </div>

            <div>
                <a href="https://wa.me/6281234567892?text=Halo%20Project%20B,%20saya%20ingin%20memesan%20Tas%20Totebag%20Anyaman" target="_blank" class="pb-btn-dark w-full py-3.5 text-center flex items-center justify-center gap-2">
                    <span>💬</span> Pesan Langsung via WhatsApp
                </a>
                <p class="text-center text-[11px] text-slate-400 mt-2">Pengiriman dari Yogyakarta ke seluruh wilayah Indonesia.</p>
            </div>
        </div>
    </div>
</div>
@endsection
