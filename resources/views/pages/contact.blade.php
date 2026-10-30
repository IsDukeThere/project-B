@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <div class="text-center space-y-2">
        <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900">Hubungi Kami</h1>
        <p class="text-xs sm:text-sm text-slate-500">Hubungi tim Project B Indonesia untuk kemitraan, konsultasi setor sampah, atau pembelian kerajinan</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @php
            $contacts = [
                ['name' => 'Admin Whatsapp 1', 'desc' => '628132743228', 'icon' => '💬', 'link' => 'https://wa.me/628132743228'],
                ['name' => 'Admin Whatsapp 2', 'desc' => '6281225169775', 'icon' => '💬', 'link' => 'https://wa.me/6281225169775'],
                ['name' => 'Instagram', 'desc' => '@projectbindonesia', 'icon' => '📸', 'link' => 'https://instagram.com/projectbindonesia'],
                ['name' => 'Instagram Katalog', 'desc' => '@projectbindonesiakatalog', 'icon' => '👜', 'link' => 'https://instagram.com/projectbindonesiakatalog'],
                ['name' => 'E-Mail', 'desc' => 'projectbindonesia@gmail.com', 'icon' => '✉️', 'link' => 'mailto:projectbindonesia@gmail.com'],
                ['name' => 'Facebook', 'desc' => 'Project B Indonesia', 'icon' => '📘', 'link' => 'https://facebook.com/projectbindonesia']
            ];
        @endphp

        @foreach($contacts as $c)
            <a href="{{ $c['link'] }}" target="_blank" class="pb-card pb-card-interactive p-5 flex items-center gap-4 block text-decoration-none">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-2xl flex-shrink-0">
                    {{ $c['icon'] }}
                </div>
                <div class="flex-grow">
                    <h3 class="font-bold text-xs sm:text-sm text-slate-900">{{ $c['name'] }}</h3>
                    <p class="text-xs text-slate-500">{{ $c['desc'] }}</p>
                </div>
                <span class="text-slate-300">›</span>
            </a>
        @endforeach
    </div>
</div>
@endsection
