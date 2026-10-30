@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="font-extrabold text-2xl sm:text-3xl text-slate-900">Katalog Produk Daur Ulang</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Dibuat dari bahan baku kemasan plastik multilayer berkualitas tinggi</p>
        </div>
        <span class="text-xs font-bold bg-slate-200 text-slate-700 px-3 py-1.5 rounded-full self-start sm:self-auto">
            {{ $products->count() }} Koleksi Tersedia
        </span>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @foreach($products as $prod)
            <div class="pb-card flex flex-col justify-between p-4 bg-white border border-slate-200 rounded-2xl shadow-sm">
                <div>
                    <!-- Cek jika produk punya gambar atau pakai ikon/placeholder -->
                    <div class="pb-img-placeholder h-40 sm:h-48 w-full mb-3 rounded-xl bg-slate-100 flex items-center justify-center text-5xl overflow-hidden">
                        @if(isset($prod->image) && file_exists(public_path($prod->image)))
                            <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                        @else
                            <span>♻️</span>
                        @endif
                    </div>

                    <h3 class="font-bold text-sm text-slate-900 line-clamp-1 mb-1">{{ $prod->name }}</h3>
                    <p class="text-xs text-slate-500 line-clamp-2 mb-3 leading-relaxed">{{ $prod->description }}</p>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ $prod->link }}" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-emerald-700 hover:text-emerald-800">Beli</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
