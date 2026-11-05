@extends('layouts.app')

@section('title', 'Lokasi Setor & Workshop')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="pb-hero-banner">
        <div class="max-w-2xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Lokasi Setor & Workshop</h1>
            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
                Kunjungi workshop kami untuk mengantarkan sampah atau berbelanja produk
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-7">
            <div class="w-full h-80 sm:h-96 rounded-2xl overflow-hidden shadow-sm border border-slate-200 relative">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4293.091211464045!2d110.3982657!3d-7.752633100000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a590a6df1cb33%3A0xb8a196e555e391b1!2sButik%20Daur%20Ulang%20Project%20B%20Indonesia!5e1!3m2!1sid!2sid!4v1792852159791!5m2!1sid!2sid"
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="lg:col-span-5 pb-card p-6 space-y-5">
            <div>
                <h2 class="font-bold text-base text-slate-900">Project B Workshop & Butik Daur Ulang</h2>
                <p class="text-xs text-slate-500 mt-1">Jl. Sukoharjo No.132 A, Gejayan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283</p>
            </div>

            <div class="space-y-2 pt-2 border-t border-slate-100 text-xs">
                <h3 class="font-bold text-slate-700 mb-2">Jam Buka Drop-Point:</h3>
                <div class="flex justify-between py-1.5 border-b border-slate-50">
                    <span class="text-slate-600">Senin–Sabtu</span>
                    <span class="font-bold text-slate-900">08.00–20.00 WIB</span>
                </div>
                <div class="flex justify-between py-1.5">
                    <span class="text-slate-600">Minggu</span>
                    <span class="font-bold text-rose-600">Tutup</span>
                </div>
            </div>

            <a href="https://maps.app.goo.gl/uL7YM4hXxWefP2Eq6" target="_blank" class="pb-btn-dark w-full text-center block">
                Buka di Google Maps
            </a>
        </div>
    </div>
</div>
@endsection
