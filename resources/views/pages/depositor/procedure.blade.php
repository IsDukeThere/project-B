@extends('layouts.depositor')

@section('title', 'Prosedur Penyetoran')

@section('content')
<style>
    /* Animasi mengambang naik turun untuk kartu ilustrasi */
    @keyframes floatUpDown {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-10px) rotate(1deg);
        }
    }
    .animate-float-custom {
        animation: floatUpDown 3.2s ease-in-out infinite;
    }
</style>

<div class="space-y-10 max-w-5xl mx-auto">

    <!-- ==================== BANNER HERO (HIJAU EMERALD - TEAL) ==================== -->
    <div class="pb-card p-6 sm:p-8 bg-gradient-to-r from-emerald-800 to-teal-800 text-white rounded-3xl shadow-lg hover:shadow-xl transition-all duration-300 relative overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 relative z-10">
            <div>
                <p class="text-xs text-emerald-200 font-medium">Halo, {{ auth()->user()->name }} 👋</p>
                <h1 class="text-xl sm:text-2xl font-black text-white mt-1">Prosedur Penyetoran Sampah</h1>
                <p class="text-xs sm:text-sm text-emerald-100 mt-1 max-w-xl leading-relaxed">
                    Pilah sampah dengan bersih dan kumpulkan poin reward setiap kg untuk ditukarkan dengan berbagai produk butik daur ulang.
                </p>
            </div>
            <a href="{{ route('depositor.form') }}" class="inline-flex items-center justify-center bg-white text-emerald-950 font-bold px-7 py-3.5 rounded-full text-xs hover:bg-emerald-50 hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-200 shadow-md self-start sm:self-auto shrink-0 group">
                <span>Setor Sekarang</span>
                <span class="ml-1.5 transition-transform duration-200 group-hover:translate-x-1">→</span>
            </a>
        </div>
    </div>

    <!-- ==================== SECTION 1: YANG BISA DISETOR ==================== -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-base sm:text-lg text-slate-900">
                Yang Bisa Disetor
            </h2>
            <span class="text-xs font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200/60 px-3 py-1 rounded-full">
                2 Kategori Diterima
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Card 1: Kemasan Multilayer (Tema Hijau seperti Header) -->
            <div class="pb-card p-6 bg-gradient-to-br from-emerald-800 to-teal-900 text-white rounded-3xl shadow-md hover:shadow-2xl hover:-translate-y-1.5 border border-emerald-700/50 transition-all duration-300 flex flex-col justify-between gap-5 group relative overflow-hidden">
                <!-- Watermark ikon samar di latar belakang -->
                <div class="absolute -right-4 -bottom-4 text-7xl opacity-15 pointer-events-none select-none group-hover:scale-110 transition-transform duration-500">
                    <img src="{{ asset('ico/icon-multilayer.png') }}" alt="Icon Multilayer" class="w-6 h-6 object-contain">
                </div>

                <div class="flex items-start justify-between gap-4 relative z-10">
                    <div class="flex items-center gap-3.5">
                        <div class="w-13 h-13 rounded-2xl bg-white/15 backdrop-blur-sm border border-white/20 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition-transform overflow-hidden">
                            <img src="{{ asset('ico/icon-multilayer.png') }}" alt="Icon Multilayer" class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider uppercase text-emerald-300 block">Kategori 01</span>
                            <h3 class="font-black text-base text-white">Kemasan Multilayer</h3>
                        </div>
                    </div>
                    <span class="text-xs font-black px-3.5 py-1.5 rounded-full bg-white text-emerald-950 shadow-md shrink-0">
                        {{ $configs['Kemasan Multilayer']->poin_per_satuan ?? 10 }} poin/kg
                    </span>
                </div>

                <!-- Gambar Ilustrasi Sampah Multilayer -->
                <div class="relative z-10 w-full rounded-2xl overflow-hidden bg-emerald-950/40 border border-emerald-600/30 aspect-[16/7] flex items-center justify-center p-3 group-hover:border-emerald-400/50 transition-all">
                    <img src="{{ asset('ico/icon-multilayer.png') }}" alt="Contoh Kemasan Multilayer" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center gap-3 text-emerald-100 text-xs font-medium\'><span class=\'text-2xl\'>📦</span><span>Bungkus Mie Instan, Sachet Kopi, Snack & Pouch Sabun</span></div>';" class="w-full h-full object-cover rounded-xl">
                </div>

                <p class="text-xs text-emerald-100/90 leading-relaxed relative z-10">
                    Bungkus mie instan, sachet minuman, detergen, minyak goreng yang sudah digunting dan dicuci bersih.
                </p>
            </div>

            <!-- Card 2: Minyak Jelantah (Card Elegan dengan Ilustrasi Gambar) -->
            <div class="pb-card p-6 bg-white rounded-3xl shadow-md hover:shadow-2xl hover:-translate-y-1.5 border border-slate-100 hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between gap-5 group relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 text-7xl opacity-5 pointer-events-none select-none group-hover:scale-110 transition-transform duration-500">
                    <img src="{{ asset('ico/icon-MinyakJelantah.png') }}" alt="Icon Multilayer" class="w-6 h-6 object-contain">
                </div>

                <div class="flex items-start justify-between gap-4 relative z-10">
                    <div class="flex items-center gap-3.5">
                        <div class="w-13 h-13 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-3xl shadow-xs group-hover:scale-110 transition-transform overflow-hidden">
                            <img src="{{ asset('ico/icon-MinyakJelantah.png') }}" alt="Icon Multilayer" class="w-6 h-6 object-contain">
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-wider uppercase text-emerald-700 block">Kategori 02</span>
                            <h3 class="font-black text-base text-slate-900 group-hover:text-emerald-800 transition-colors">Minyak Jelantah</h3>
                        </div>
                    </div>
                    <span class="badge-success text-xs font-black px-3.5 py-1.5 rounded-full bg-emerald-700 text-white shadow-md shrink-0">
                        {{ $configs['Minyak Jelantah']->poin_per_satuan ?? 10 }} poin/liter
                    </span>
                </div>

                <!-- Gambar Ilustrasi Minyak Jelantah -->
                <div class="relative z-10 w-full rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 aspect-[16/7] flex items-center justify-center p-3 group-hover:border-emerald-200 transition-all">
                    <img src="{{ asset('ico/icon-MinyakJelantah.png') }}" alt="Contoh Minyak Jelantah" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'flex items-center gap-3 text-slate-600 text-xs font-medium\'><span class=\'text-2xl\'>🧴</span><span>Minyak Masak Bekas Disaring dalam Jeriken/Botol Rapat</span></div>';" class="w-full h-full object-cover rounded-xl">
                </div>

                <p class="text-xs text-slate-500 leading-relaxed relative z-10">
                    Simpan dalam botol atau jeriken tertutup rapat, telah disaring bebas dari sisa remah makanan atau air.
                </p>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION 2: KETENTUAN KUALITAS (2 KARTU TEMA HIJAU) ==================== -->
    <section class="space-y-4">
        <h2 class="font-extrabold text-base sm:text-lg text-slate-900">Ketentuan Kualitas</h2>

        <!-- DUA CARD SAJA: 1 CAUTION RINGKAS TEMA HIJAU + 1 CARD GAMBAR ANIMASI NAIK TURUN -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-stretch">
            
            <!-- CARD 1: CAUTION RINGKAS (TEMA HIJAU ELEGAN, TIDAK KUNING & TIDAK BANYAK TEKS) -->
            <div class="md:col-span-8 pb-card p-6 bg-gradient-to-br from-emerald-900 to-teal-950 text-white rounded-3xl border border-emerald-700/60 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between gap-4">
                <div class="space-y-2.5">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-800/80 border border-emerald-600/50 text-[11px] font-bold text-emerald-200">
                        <span>⚠️</span>
                        <span>Perhatian Syarat Mutlak</span>
                    </div>

                    <h3 class="text-base sm:text-lg font-black text-white tracking-tight">
                        Wajib: Kosong, Bersih, dan Kering
                    </h3>

                    <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                        Sampah harus bebas dari sisa air, minyak basah, atau sisa makanan hewani, serta <strong>bukan berasal dari produk non-halal</strong> agar higienis dan siap diproses pengrajin.
                    </p>
                </div>

                <!-- 3 Syarat Cepat -->
                <div class="grid grid-cols-3 gap-2.5 pt-2 border-t border-emerald-800/80">
                    <div class="p-2.5 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10 text-center">
                        <span class="block text-emerald-300 font-black text-xs">01</span>
                        <span class="text-[11px] font-bold text-white">Kosong</span>
                    </div>
                    <div class="p-2.5 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10 text-center">
                        <span class="block text-emerald-300 font-black text-xs">02</span>
                        <span class="text-[11px] font-bold text-white">Bersih</span>
                    </div>
                    <div class="p-2.5 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/10 text-center">
                        <span class="block text-emerald-300 font-black text-xs">03</span>
                        <span class="text-[11px] font-bold text-white">Kering</span>
                    </div>
                </div>
            </div>

            <!-- CARD 2: KARTU ANIMASI KECIL GAMBAR BERGERAK NAIK-TURUN SENDIRI -->
            <div class="md:col-span-4 pb-card p-6 bg-white rounded-3xl border border-slate-100 shadow-md hover:shadow-xl hover:border-emerald-200 transition-all duration-300 flex flex-col items-center justify-center text-center gap-3 group">
                <!-- Gambar / Ilustrasi dengan Animasi Float Naik-Turun -->
                <div class="animate-float-custom p-4 rounded-3xl bg-emerald-50 border border-emerald-100/80 shadow-sm flex items-center justify-center">
                    <img src="{{ asset('images/clean-recycle-icon.png') }}" alt="Ilustrasi Daur Ulang Bersih" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-20 h-20 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-4xl shadow-md text-white\'>✨♻️</div>';" class="w-20 h-20 object-contain">
                </div>

                <div class="space-y-1">
                    <span class="text-[10px] font-black uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full">
                        Standar Kerajinan
                    </span>
                    <h4 class="font-extrabold text-xs text-slate-900 mt-1">Sampah Bersih & Kuat</h4>
                    <p class="text-[11px] text-slate-500 leading-snug">
                        Memudahkan pengrajin membuat produk bernilai tinggi tanpa bau.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- ==================== SECTION 3: 4 LANGKAH PENYETORAN & CARD VIDEO MENCOLOK ==================== -->
    <section class="space-y-6">
        <div>
            <h2 class="font-extrabold text-base sm:text-lg text-slate-900">4 Langkah Penyetoran</h2>
            <p class="text-xs text-slate-500 mt-0.5">Alur mudah dan terverifikasi untuk menyetor sampah Anda ke Project B Indonesia.</p>
        </div>

        <!-- 4 Langkah Grid Horizontal -->
        <div class="pb-card p-6 sm:p-7 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex items-start gap-3.5 p-3 rounded-2xl hover:bg-emerald-50/40 transition-colors group">
                <span class="w-8 h-8 rounded-2xl bg-emerald-700 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 group-hover:bg-emerald-800 transition-all">
                    1
                </span>
                <div>
                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-emerald-800 transition-colors">Siapkan Sampah</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Pilah per jenis dan pastikan bersih serta kering.</p>
                </div>
            </div>

            <div class="flex items-start gap-3.5 p-3 rounded-2xl hover:bg-emerald-50/40 transition-colors group">
                <span class="w-8 h-8 rounded-2xl bg-emerald-700 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 group-hover:bg-emerald-800 transition-all">
                    2
                </span>
                <div>
                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-emerald-800 transition-colors">Isi Data Setoran</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Tentukan jenis, perkiraan jumlah, dan cara serah.</p>
                </div>
            </div>

            <div class="flex items-start gap-3.5 p-3 rounded-2xl hover:bg-emerald-50/40 transition-colors group">
                <span class="w-8 h-8 rounded-2xl bg-emerald-700 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 group-hover:bg-emerald-800 transition-all">
                    3
                </span>
                <div>
                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-emerald-800 transition-colors">Serahkan</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Drop langsung ke butik atau kirim melalui kurir.</p>
                </div>
            </div>

            <div class="flex items-start gap-3.5 p-3 rounded-2xl hover:bg-emerald-50/40 transition-colors group">
                <span class="w-8 h-8 rounded-2xl bg-emerald-700 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 group-hover:bg-emerald-800 transition-all">
                    4
                </span>
                <div>
                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-emerald-800 transition-colors">Tunggu Verifikasi</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">Admin menimbang dan poin otomatis masuk.</p>
                </div>
            </div>
        </div>

        <!-- ==================== CARD VIDEO PANDUAN DIBUAT SANGAT MENCOLOK (CINEMATIC) ==================== -->
        <div class="relative p-1 rounded-[32px] bg-gradient-to-r from-emerald-600 via-teal-400 to-emerald-700 shadow-2xl hover:shadow-emerald-900/40 transition-all duration-300">
            <div class="bg-gradient-to-br from-emerald-800 to-teal-900 rounded-[28px] p-6 sm:p-8 space-y-5 text-white">
                
                <!-- Header Video Mencolok -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-800/80 pb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400 text-xl shadow-inner">
                            🎥
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-black text-base sm:text-lg text-white">Video Panduan: Cara Mencuci Sampah dengan Benar</h3>
                                <span class="hidden sm:inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-black border border-emerald-500/30">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span> WAJIB TONTON
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">Panduan resmi langkah pembersihan sampah multilayer sebelum disetorkan.</p>
                        </div>
                    </div>

                    <span class="text-xs text-emerald-400 font-bold px-3 py-1 rounded-xl bg-slate-900 border border-slate-800 self-start sm:self-auto">
                        File: 1025.mp4
                    </span>
                </div>

                <!-- Pemutar Video Besar & Mencolok (Tanpa Poin Penting di Sampingnya) -->
                <div class="overflow-hidden rounded-2xl bg-black border-2 border-slate-800 shadow-2xl relative group">
                    <video class="w-full aspect-video sm:aspect-[21/9] object-cover focus:outline-none" controls preload="metadata" playsinline>
                        <source src="{{ asset('vid/1025.mp4') }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video HTML5. Silakan letakkan file video 1025.mp4 di folder public/videos/.
                    </video>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400 pt-1">
                    <span class="flex items-center gap-1.5">
                        <span class="text-emerald-400">💡</span> Ikuti teknik mencuci pada video untuk memastikan sampah Anda langsung lolos verifikasi poin.
                    </span>
                    <span class="text-[11px] font-semibold text-emerald-400">Project B Indonesia</span>
                </div>

            </div>
        </div>
    </section>

    <!-- ==================== SECTION 4: CARA MENYERAHKAN ==================== -->
    <section class="space-y-4">
        <div>
            <h2 class="font-extrabold text-base sm:text-lg text-slate-900">Cara Menyerahkan</h2>
            <p class="text-xs text-slate-500 mt-0.5">Pilih salah satu metode penyerahan sampah yang paling mudah untuk Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Metode 1: Drop Langsung (DIWARNAI LATAR BELAKANG HIJAU SEPERTI HEADER) -->
            <div class="pb-card p-6 sm:p-7 bg-gradient-to-br from-emerald-800 to-teal-900 text-white rounded-3xl shadow-md hover:shadow-2xl hover:-translate-y-1.5 border border-emerald-700/50 transition-all duration-300 space-y-4 group">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl p-2.5 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 group-hover:scale-110 transition-transform">
                            🏪
                        </span>
                        <div>
                            <span class="text-[10px] font-bold text-emerald-300 uppercase tracking-wider block">Metode 01</span>
                            <h3 class="font-black text-base text-white">Drop Langsung</h3>
                        </div>
                    </div>
                    <span class="text-[10px] font-black px-3 py-1 rounded-full bg-white text-emerald-950 shadow-sm">
                        Bebas Ongkir
                    </span>
                </div>
                
                <div class="space-y-1.5 pt-1 border-t border-emerald-700/60">
                    <p class="text-sm font-bold text-emerald-100">Butik Daur Ulang, Jl. Sukoharjo No.132 A, Gejayan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283</p>
                    <p class="text-xs text-emerald-200/90 leading-relaxed">
                        Serahkan langsung ke petugas timbang kami di lokasi untuk verifikasi poin secara langsung di tempat.
                    </p>
                    <div class="inline-flex items-center gap-1.5 text-xs text-emerald-300 font-semibold pt-1">
                        <span>🕒</span>
                        <span>Operasional: Senin–Sabtu (08.00–20.00 WIB)</span>
                    </div>
                </div>
            </div>

            <!-- Metode 2: Kirim Via Kurir (Card Putih Bersih dengan Aksen Hijau Interaktif) -->
            <div class="pb-card p-6 sm:p-7 bg-white rounded-3xl border border-slate-100 shadow-md hover:shadow-2xl hover:-translate-y-1.5 hover:border-emerald-300 transition-all duration-300 space-y-4 group flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl p-2.5 rounded-2xl bg-emerald-50 border border-emerald-100 group-hover:scale-110 transition-transform">
                                🚚
                            </span>
                            <div>
                                <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block">Metode 02</span>
                                <h3 class="font-black text-base text-slate-900 group-hover:text-emerald-800 transition-colors">Kirim Via Kurir</h3>
                            </div>
                        </div>
                        <span class="text-[10px] font-black px-3 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                            Ekspedisi
                        </span>
                    </div>

                    <div class="space-y-1.5 pt-3 border-t border-slate-100 mt-3">
                        <p class="text-sm font-bold text-slate-800">Ekspedisi ke Alamat Workshop Project B</p>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Gunakan kurir instan (Gojek/Grab) atau ekspedisi langganan Anda (JNE/J&T/SiCepat).
                        </p>
                    </div>
                </div>

                <a href="https://maps.app.goo.gl/uL7YM4hXxWefP2Eq6" target="_blank" class="inline-flex items-center justify-between p-3.5 rounded-2xl bg-emerald-50 hover:bg-emerald-700 text-emerald-900 hover:text-white font-bold text-xs transition-all duration-200 group/btn mt-2 block">
                    <span>Lihat Alamat Lengkap & Titik Kirim</span>
                    <span class="transition-transform duration-200 group-hover/btn:translate-x-1.5">→</span>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
