@extends('layouts.app')

@section('title', 'Tentang Kami')

@push('styles')
    <style>
        .card-perspective { perspective: 1200px; }
        .flip-card-inner {
            position: relative; width: 100%; height: 100%;
            transform-style: preserve-3d;
            -webkit-transform-style: preserve-3d; /* Fix Safari */
            transition: transform 0.65s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }

        .flip-card-inner.is-flipped {
            transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg); /* Fix Safari */
        }

        .flip-card-front, .flip-card-back {
            position: absolute; inset: 0; width: 100%; height: 100%;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden; /* Fix Safari */
            /* Paksa rendering GPU agar depan-belakang tidak tembus di HP */
            transform: rotateY(0deg) translateZ(0);
            -webkit-transform: rotateY(0deg) translateZ(0);
            border-radius: 28px;
        }

        .flip-card-back {
            transform: rotateY(180deg) translateZ(0);
            -webkit-transform: rotateY(180deg) translateZ(0);
        }

        .card-perspective:hover .flip-card-inner:not(.is-flipped) {
            transform: translateY(-8px) rotateX(4deg);
        }

        @keyframes flowGreen { 0% { stroke-dashoffset: 28; } 100% { stroke-dashoffset: 0; } }
        @keyframes flowBlue { 0% { stroke-dashoffset: 28; } 100% { stroke-dashoffset: 0; } }
        .animate-flow-green { stroke-dasharray: 6 6; animation: flowGreen var(--anim-speed, 1.4s) linear infinite; }
        .animate-flow-blue { stroke-dasharray: 6 6; animation: flowBlue var(--anim-speed, 1.4s) linear infinite; }
        /* Radar Pulse Expansion */
        @keyframes radarPulse { 0% { r: 6; opacity: 0.9; stroke-width: 2.5; } 70% { opacity: 0.35; } 100% { r: 45; opacity: 0; stroke-width: 0.5; } }
        /* .radar-wave-1 { animation: radarPulse 2.6s cubic-bezier(0.2, 0.8, 0.4, 1) infinite; }
        .radar-wave-2 { animation: radarPulse 2.6s cubic-bezier(0.2, 0.8, 0.4, 1) infinite; animation-delay: 1.3s; } */
        .radar-wave-1, .radar-wave-2 { pointer-events: none; }
        /* Point Glow Hover */
        /* .node-point { cursor: pointer; transition: transform 0.25s ease; }
        .node-point:hover { transform: scale(1.2); } */
        /* Custom Scrollbar */
        .node-point * { transform-box: fill-box; transform-origin: center; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
@endpush

@section('content')
<div class="space-y-10">
    <div class="pb-hero-banner">
        <div class="max-w-2xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Tentang Kami</h1>
            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
                Dipercaya instansi, sekolah, komunitas, dan ratusan warga yang berkontribusi nyata mengurangi timbulan sampah.
            </p>
        </div>
    </div>

    <!-- ===== PROFIL PERUSAHAAN ===== -->
    <section id="profil" class="space-y-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-7 space-y-4">
                <div class="text-xs uppercase font-extrabold tracking-wider text-emerald-700">Profil Perusahaan</div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">Tentang Project B Indonesia</h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Project B Indonesia adalah usaha sosial pengolahan sampah yang mengubah limbah rumah tangga dan sekolah menjadi produk bernilai guna. Kami bekerja bersama warga, sekolah, dan instansi agar pengelolaan sampah menjadi kebiasaan, bukan beban.
                </p>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Setiap tahap pengolahan didokumentasikan secara terbuka sehingga masyarakat dapat melihat langsung ke mana sampah mereka pergi dan apa dampaknya.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                    <div class="bg-emerald-50 rounded-2xl p-4 text-center border border-emerald-100">
                        <b class="block text-2xl font-extrabold text-emerald-800">2008</b>
                        <span class="text-xs text-slate-500 font-medium">Tahun berdiri</span>
                    </div>
                    <div class="bg-emerald-50 rounded-2xl p-4 text-center border border-emerald-100">
                        <b class="block text-2xl font-extrabold text-emerald-800">1.677.052</b>
                        <span class="text-xs text-slate-500 font-medium">Sampah Sachet Terolah</span>
                    </div>
                    <div class="bg-emerald-50 rounded-2xl p-4 text-center border border-emerald-100">
                        <b class="block text-2xl font-extrabold text-emerald-800">1500++</b>
                        <span class="text-xs text-slate-500 font-medium">Warga terlibat</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-4">
                <div class="pb-card p-5 border-l-4 border-l-emerald-600">
                    <h3 class="font-bold text-base text-slate-900 mb-1">Visi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Mewujudkan lingkungan berkelanjutan melalui edukasi dan inovasi pengolahan sampah menjadi produk bernilai ekonomi.
                    </p>
                </div>
                <div class="pb-card p-5 border-l-4 border-l-emerald-600">
                    <h3 class="font-bold text-base text-slate-900 mb-1">Misi</h3>
                    <ul class="mt-2 space-y-1.5 pl-4 list-disc text-xs text-slate-600 leading-relaxed">
                        <li>Meningkatkan kesadaran masyarakat terhadap pentingnya pengelolaan sampah.</li>
                        <li>Mendorong kebiasaan memilah dan menyumbangkan sampah secara sukarela.</li>
                        <li>Mengembangkan inovasi pengolahan sampah menjadi produk bernilai guna dan jual.</li>
                        <li>Menciptakan peluang ekonomi melalui pemanfaatan sampah secara berkelanjutan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SUSTAINABLE DEVELOPMENT GOALS (SDGs) ===== -->
    <section id="sdgs" class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">

      <!-- ==================== KARTU 1: SDG 11 ==================== -->
      <div class="card-perspective w-full max-w-[305px] h-[470px]">
        <div class="flip-card-inner rounded-[28px] focus:outline-none" onclick="toggleCard(this)" tabindex="0" onkeydown="handleCardKey(event, this)">

          <!-- SISI DEPAN (FRONT) -->
          <div class="flip-card-front p-6 flex flex-col justify-between text-white shadow-2xl shadow-black/40 bg-gradient-to-b from-[#FD9D24] to-[#E58814] border border-white/20 text-left">
            <!-- Watermark Nomor Besar -->
            <div class="absolute -right-8 -bottom-10 pointer-events-none opacity-10 select-none">
              <span class="text-[14rem] font-black leading-none">11</span>
            </div>

            <!-- Header Depan -->
            <div class="flex items-start justify-between relative z-10">
              <div class="w-14 h-14 rounded-2xl border-2 border-white/90 flex flex-col items-center justify-center bg-white/10 backdrop-blur-sm shadow-inner">
                <span class="text-xl font-black leading-none tracking-tight">11</span>
                <span class="text-[10px] font-bold tracking-widest uppercase mt-0.5 opacity-95">SDG</span>
              </div>
              <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/20 text-white/90 text-xs font-semibold border border-white/15">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-white/80"></i>
                <span>Project B</span>
              </div>
            </div>

            <!-- Wadah Foto / Ilustrasi Depan -->
            <div class="relative z-10 my-auto py-2">
              <div class="w-full aspect-[4/3] rounded-2xl bg-black/15 border border-white/25 overflow-hidden flex flex-col items-center justify-center p-4 relative group-hover:bg-black/20 transition-colors">
                <!-- Jika ingin pasang foto asli, ganti div di bawah dengan: <img src="/images/sdg11.jpg" class="w-full h-full object-cover rounded-xl"> -->
                <div class="w-16 h-16 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center text-white mb-2.5 shadow-sm">
                  <i data-lucide="building-2" class="w-8 h-8"></i>
                </div>
                <span class="text-xs font-bold text-center text-white/95 px-2 line-clamp-1">Komunitas & Pemukiman</span>
                <span class="text-[10px] text-white/70 mt-1 flex items-center gap-1">
                  <i data-lucide="image" class="w-3 h-3"></i> Foto Program SDG
                </span>
              </div>
            </div>

            <!-- Bawah Depan: Nama SDG -->
            <div class="relative z-10 space-y-2">
              <div>
                <h3 class="font-extrabold text-sm sm:text-[15px] leading-tight tracking-tight uppercase line-clamp-2">
                  SUSTAINABLE CITIES AND COMMUNITIES
                </h3>
                <p class="text-xs text-white/90 font-medium leading-snug mt-1 line-clamp-2">
                  Kota dan Permukiman yang Berkelanjutan
                </p>
              </div>

              <div class="pt-2 border-t border-white/20 flex items-center justify-between text-xs text-white/85">
                <span class="text-[11px] font-semibold flex items-center gap-1.5">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5"></i>
                  Klik untuk keterangan
                </span>
                <span class="text-[10px] px-2 py-0.5 rounded-md bg-white/20 font-bold uppercase tracking-wider">Flip ↻</span>
              </div>
            </div>
          </div>

          <!-- SISI BELAKANG (BACK) -->
          <div class="flip-card-back p-6 flex flex-col justify-between text-slate-100 shadow-2xl shadow-black/40 bg-slate-900 border border-slate-700/80 text-left">
            <div class="absolute top-0 left-0 right-0 h-2 bg-[#FD9D24]"></div>

            <div class="space-y-3 relative z-10">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white text-base shadow-sm bg-[#FD9D24]">11</div>
                  <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Keterangan Komitmen</span>
                    <span class="text-xs font-bold text-white">SDG #11</span>
                  </div>
                </div>
                <span class="text-[10px] px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 border border-slate-700 font-semibold">Detail</span>
              </div>

              <div>
                <h4 class="font-extrabold text-sm text-white tracking-tight uppercase leading-snug">SUSTAINABLE CITIES AND COMMUNITIES</h4>
                <p class="text-xs font-semibold mt-0.5 text-[#FD9D24]">Kota dan Permukiman yang Berkelanjutan</p>
              </div>
              <div class="h-px bg-slate-800 w-full"></div>
            </div>

            <!-- Teks Deskripsi dari Gambar Asli -->
            <div class="my-auto py-2 relative z-10 overflow-y-auto max-h-[195px] pr-1 desc-scroll">
              <p class="text-xs text-slate-300 leading-relaxed font-normal text-justify">
                Mendorong keterlibatan masyarakat dalam pengumpulan dan pengelolaan sampah plastik untuk mendukung lingkungan yang lebih bersih dan berkelanjutan.
              </p>
              <div class="flex flex-wrap gap-1.5 mt-3">
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Pengelolaan Sampah</span>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Komunitas Bersih</span>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Lingkungan Hijau</span>
              </div>
            </div>

            <!-- Footer Belakang -->
            <div class="pt-3 border-t border-slate-800 relative z-10 flex items-center justify-between text-xs">
              <span class="text-[11px] text-slate-400 flex items-center gap-1 font-medium truncate max-w-[170px]">
                <i data-lucide="check-circle-2" class="w-3.5 h-3.5 shrink-0 text-[#FD9D24]"></i>
                <span class="truncate">Pemberdayaan Komunitas</span>
              </span>
              <span class="text-[11px] font-bold text-slate-200 hover:text-white flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 transition-colors shrink-0">
                <span>Kembali</span>
                <i data-lucide="rotate-cw" class="w-3 h-3"></i>
              </span>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== KARTU 2: SDG 12 ==================== -->
      <div class="card-perspective w-full max-w-[305px] h-[470px]">
        <div class="flip-card-inner rounded-[28px] focus:outline-none" onclick="toggleCard(this)" tabindex="0" onkeydown="handleCardKey(event, this)">

          <!-- SISI DEPAN (FRONT) -->
          <div class="flip-card-front p-6 flex flex-col justify-between text-white shadow-2xl shadow-black/40 bg-gradient-to-b from-[#BF8B2E] to-[#A47420] border border-white/20 text-left">
            <div class="absolute -right-8 -bottom-10 pointer-events-none opacity-10 select-none">
              <span class="text-[14rem] font-black leading-none">12</span>
            </div>

            <div class="flex items-start justify-between relative z-10">
              <div class="w-14 h-14 rounded-2xl border-2 border-white/90 flex flex-col items-center justify-center bg-white/10 backdrop-blur-sm shadow-inner">
                <span class="text-xl font-black leading-none tracking-tight">12</span>
                <span class="text-[10px] font-bold tracking-widest uppercase mt-0.5 opacity-95">SDG</span>
              </div>
              <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/20 text-white/90 text-xs font-semibold border border-white/15">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-white/80"></i>
                <span>Project B</span>
              </div>
            </div>

            <div class="relative z-10 my-auto py-2">
              <div class="w-full aspect-[4/3] rounded-2xl bg-black/15 border border-white/25 overflow-hidden flex flex-col items-center justify-center p-4 relative group-hover:bg-black/20 transition-colors">
                <div class="w-16 h-16 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center text-white mb-2.5 shadow-sm">
                  <i data-lucide="recycle" class="w-8 h-8"></i>
                </div>
                <span class="text-xs font-bold text-center text-white/95 px-2 line-clamp-1">Butik Daur Ulang & Upcycling</span>
                <span class="text-[10px] text-white/70 mt-1 flex items-center gap-1">
                  <i data-lucide="image" class="w-3 h-3"></i> Foto Program SDG
                </span>
              </div>
            </div>

            <div class="relative z-10 space-y-2">
              <div>
                <h3 class="font-extrabold text-sm sm:text-[15px] leading-tight tracking-tight uppercase line-clamp-2">
                  RESPONSIBLE CONSUMPTION AND PRODUCTION
                </h3>
                <p class="text-xs text-white/90 font-medium leading-snug mt-1 line-clamp-2">
                  Konsumsi dan Produksi yang Bertanggung Jawab
                </p>
              </div>

              <div class="pt-2 border-t border-white/20 flex items-center justify-between text-xs text-white/85">
                <span class="text-[11px] font-semibold flex items-center gap-1.5">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5"></i>
                  Klik untuk keterangan
                </span>
                <span class="text-[10px] px-2 py-0.5 rounded-md bg-white/20 font-bold uppercase tracking-wider">Flip ↻</span>
              </div>
            </div>
          </div>

          <!-- SISI BELAKANG (BACK) -->
          <div class="flip-card-back p-6 flex flex-col justify-between text-slate-100 shadow-2xl shadow-black/40 bg-slate-900 border border-slate-700/80 text-left">
            <div class="absolute top-0 left-0 right-0 h-2 bg-[#BF8B2E]"></div>

            <div class="space-y-3 relative z-10">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white text-base shadow-sm bg-[#BF8B2E]">12</div>
                  <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Keterangan Komitmen</span>
                    <span class="text-xs font-bold text-white">SDG #12</span>
                  </div>
                </div>
                <span class="text-[10px] px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 border border-slate-700 font-semibold">Detail</span>
              </div>

              <div>
                <h4 class="font-extrabold text-sm text-white tracking-tight uppercase leading-snug">RESPONSIBLE CONSUMPTION AND PRODUCTION</h4>
                <p class="text-xs font-semibold mt-0.5 text-[#BF8B2E]">Konsumsi dan Produksi yang Bertanggung Jawab</p>
              </div>
              <div class="h-px bg-slate-800 w-full"></div>
            </div>

            <!-- Teks Deskripsi dari Gambar Asli -->
            <div class="my-auto py-2 relative z-10 overflow-y-auto max-h-[195px] pr-1 desc-scroll">
              <p class="text-xs text-slate-300 leading-relaxed font-normal text-justify">
                Mendukung pengurangan sampah plastik melalui pemanfaatan kembali sebagai bahan baku kerajinan tangan, sejalan dengan target 12.5 tentang pengurangan timbulan sampah melalui pencegahan, pengurangan, daur ulang, dan penggunaan kembali.
              </p>
              <div class="flex flex-wrap gap-1.5 mt-3">
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Daur Ulang</span>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Bahan Baku Kerajinan</span>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Target 12.5</span>
              </div>
            </div>

            <!-- Footer Belakang -->
            <div class="pt-3 border-t border-slate-800 relative z-10 flex items-center justify-between text-xs">
              <span class="text-[11px] text-slate-400 flex items-center gap-1 font-medium truncate max-w-[170px]">
                <i data-lucide="check-circle-2" class="w-3.5 h-3.5 shrink-0 text-[#BF8B2E]"></i>
                <span class="truncate">Target 12.5 (3R & Pencegahan)</span>
              </span>
              <span class="text-[11px] font-bold text-slate-200 hover:text-white flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 transition-colors shrink-0">
                <span>Kembali</span>
                <i data-lucide="rotate-cw" class="w-3 h-3"></i>
              </span>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== KARTU 3: SDG 8 ==================== -->
      <div class="card-perspective w-full max-w-[305px] h-[470px]">
        <div class="flip-card-inner rounded-[28px] focus:outline-none" onclick="toggleCard(this)" tabindex="0" onkeydown="handleCardKey(event, this)">

          <!-- SISI DEPAN (FRONT) -->
          <div class="flip-card-front p-6 flex flex-col justify-between text-white shadow-2xl shadow-black/40 bg-gradient-to-b from-[#A21942] to-[#861234] border border-white/20 text-left">
            <div class="absolute -right-8 -bottom-10 pointer-events-none opacity-10 select-none">
              <span class="text-[14rem] font-black leading-none">8</span>
            </div>

            <div class="flex items-start justify-between relative z-10">
              <div class="w-14 h-14 rounded-2xl border-2 border-white/90 flex flex-col items-center justify-center bg-white/10 backdrop-blur-sm shadow-inner">
                <span class="text-xl font-black leading-none tracking-tight">8</span>
                <span class="text-[10px] font-bold tracking-widest uppercase mt-0.5 opacity-95">SDG</span>
              </div>
              <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/20 text-white/90 text-xs font-semibold border border-white/15">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-white/80"></i>
                <span>Project B</span>
              </div>
            </div>

            <div class="relative z-10 my-auto py-2">
              <div class="w-full aspect-[4/3] rounded-2xl bg-black/15 border border-white/25 overflow-hidden flex flex-col items-center justify-center p-4 relative group-hover:bg-black/20 transition-colors">
                <div class="w-16 h-16 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center text-white mb-2.5 shadow-sm">
                  <i data-lucide="trending-up" class="w-8 h-8"></i>
                </div>
                <span class="text-xs font-bold text-center text-white/95 px-2 line-clamp-1">Pengrajin & UMKM Berdaya</span>
                <span class="text-[10px] text-white/70 mt-1 flex items-center gap-1">
                  <i data-lucide="image" class="w-3 h-3"></i> Foto Program SDG
                </span>
              </div>
            </div>

            <div class="relative z-10 space-y-2">
              <div>
                <h3 class="font-extrabold text-sm sm:text-[15px] leading-tight tracking-tight uppercase line-clamp-2">
                  DECENT WORK AND ECONOMIC GROWTH
                </h3>
                <p class="text-xs text-white/90 font-medium leading-snug mt-1 line-clamp-2">
                  Pekerjaan Layak dan Pertumbuhan Ekonomi
                </p>
              </div>

              <div class="pt-2 border-t border-white/20 flex items-center justify-between text-xs text-white/85">
                <span class="text-[11px] font-semibold flex items-center gap-1.5">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5"></i>
                  Klik untuk keterangan
                </span>
                <span class="text-[10px] px-2 py-0.5 rounded-md bg-white/20 font-bold uppercase tracking-wider">Flip ↻</span>
              </div>
            </div>
          </div>

          <!-- SISI BELAKANG (BACK) -->
          <div class="flip-card-back p-6 flex flex-col justify-between text-slate-100 shadow-2xl shadow-black/40 bg-slate-900 border border-slate-700/80 text-left">
            <div class="absolute top-0 left-0 right-0 h-2 bg-[#A21942]"></div>

            <div class="space-y-3 relative z-10">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white text-base shadow-sm bg-[#A21942]">8</div>
                  <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Keterangan Komitmen</span>
                    <span class="text-xs font-bold text-white">SDG #8</span>
                  </div>
                </div>
                <span class="text-[10px] px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 border border-slate-700 font-semibold">Detail</span>
              </div>

              <div>
                <h4 class="font-extrabold text-sm text-white tracking-tight uppercase leading-snug">DECENT WORK AND ECONOMIC GROWTH</h4>
                <p class="text-xs font-semibold mt-0.5 text-[#A21942]">Pekerjaan Layak dan Pertumbuhan Ekonomi</p>
              </div>
              <div class="h-px bg-slate-800 w-full"></div>
            </div>

            <!-- Teks Deskripsi dari Gambar Asli -->
            <div class="my-auto py-2 relative z-10 overflow-y-auto max-h-[195px] pr-1 desc-scroll">
              <p class="text-xs text-slate-300 leading-relaxed font-normal text-justify">
                Mendukung pengembangan UMKM melalui pengolahan sampah plastik menjadi produk kerajinan bernilai tambah serta penyediaan informasi mengenai produk dan kegiatan usaha.
              </p>
              <div class="flex flex-wrap gap-1.5 mt-3">
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Pemberdayaan UMKM</span>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Nilai Tambah</span>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Ekonomi Sirkular</span>
              </div>
            </div>

            <!-- Footer Belakang -->
            <div class="pt-3 border-t border-slate-800 relative z-10 flex items-center justify-between text-xs">
              <span class="text-[11px] text-slate-400 flex items-center gap-1 font-medium truncate max-w-[170px]">
                <i data-lucide="check-circle-2" class="w-3.5 h-3.5 shrink-0 text-[#A21942]"></i>
                <span class="truncate">Pemberdayaan UMKM Kreatif</span>
              </span>
              <span class="text-[11px] font-bold text-slate-200 hover:text-white flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 transition-colors shrink-0">
                <span>Kembali</span>
                <i data-lucide="rotate-cw" class="w-3 h-3"></i>
              </span>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== KARTU 4: SDG 9 ==================== -->
      <div class="card-perspective w-full max-w-[305px] h-[470px]">
        <div class="flip-card-inner rounded-[28px] focus:outline-none" onclick="toggleCard(this)" tabindex="0" onkeydown="handleCardKey(event, this)">

          <!-- SISI DEPAN (FRONT) -->
          <div class="flip-card-front p-6 flex flex-col justify-between text-white shadow-2xl shadow-black/40 bg-gradient-to-b from-[#F36E25] to-[#D55A16] border border-white/20 text-left">
            <div class="absolute -right-8 -bottom-10 pointer-events-none opacity-10 select-none">
              <span class="text-[14rem] font-black leading-none">9</span>
            </div>

            <div class="flex items-start justify-between relative z-10">
              <div class="w-14 h-14 rounded-2xl border-2 border-white/90 flex flex-col items-center justify-center bg-white/10 backdrop-blur-sm shadow-inner">
                <span class="text-xl font-black leading-none tracking-tight">9</span>
                <span class="text-[10px] font-bold tracking-widest uppercase mt-0.5 opacity-95">SDG</span>
              </div>
              <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/20 text-white/90 text-xs font-semibold border border-white/15">
                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-white/80"></i>
                <span>Project B</span>
              </div>
            </div>

            <div class="relative z-10 my-auto py-2">
              <div class="w-full aspect-[4/3] rounded-2xl bg-black/15 border border-white/25 overflow-hidden flex flex-col items-center justify-center p-4 relative group-hover:bg-black/20 transition-colors">
                <div class="w-16 h-16 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center text-white mb-2.5 shadow-sm">
                  <i data-lucide="cpu" class="w-8 h-8"></i>
                </div>
                <span class="text-xs font-bold text-center text-white/95 px-2 line-clamp-1">Inovasi Rantai Pasok Digital</span>
                <span class="text-[10px] text-white/70 mt-1 flex items-center gap-1">
                  <i data-lucide="image" class="w-3 h-3"></i> Foto Program SDG
                </span>
              </div>
            </div>

            <div class="relative z-10 space-y-2">
              <div>
                <h3 class="font-extrabold text-sm sm:text-[15px] leading-tight tracking-tight uppercase line-clamp-2">
                  INDUSTRY, INNOVATION AND INFRASTRUCTURE
                </h3>
                <p class="text-xs text-white/90 font-medium leading-snug mt-1 line-clamp-2">
                  Industri, Inovasi, dan Infrastruktur
                </p>
              </div>

              <div class="pt-2 border-t border-white/20 flex items-center justify-between text-xs text-white/85">
                <span class="text-[11px] font-semibold flex items-center gap-1.5">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5"></i>
                  Klik untuk keterangan
                </span>
                <span class="text-[10px] px-2 py-0.5 rounded-md bg-white/20 font-bold uppercase tracking-wider">Flip ↻</span>
              </div>
            </div>
          </div>

          <!-- SISI BELAKANG (BACK) -->
          <div class="flip-card-back p-6 flex flex-col justify-between text-slate-100 shadow-2xl shadow-black/40 bg-slate-900 border border-slate-700/80 text-left">
            <div class="absolute top-0 left-0 right-0 h-2 bg-[#F36E25]"></div>

            <div class="space-y-3 relative z-10">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black text-white text-base shadow-sm bg-[#F36E25]">9</div>
                  <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Keterangan Komitmen</span>
                    <span class="text-xs font-bold text-white">SDG #9</span>
                  </div>
                </div>
                <span class="text-[10px] px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 border border-slate-700 font-semibold">Detail</span>
              </div>

              <div>
                <h4 class="font-extrabold text-sm text-white tracking-tight uppercase leading-snug">INDUSTRY, INNOVATION AND INFRASTRUCTURE</h4>
                <p class="text-xs font-semibold mt-0.5 text-[#F36E25]">Industri, Inovasi, dan Infrastruktur</p>
              </div>
              <div class="h-px bg-slate-800 w-full"></div>
            </div>

            <!-- Teks Deskripsi dari Gambar Asli -->
            <div class="my-auto py-2 relative z-10 overflow-y-auto max-h-[195px] pr-1 desc-scroll">
              <p class="text-xs text-slate-300 leading-relaxed font-normal text-justify">
                Mendorong penerapan inovasi teknologi informasi melalui website yang mendukung digitalisasi pengelolaan informasi dan aliran material dalam rantai pasok balik sampah plastik.
              </p>
              <div class="flex flex-wrap gap-1.5 mt-3">
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Digitalisasi Website</span>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Reverse Logistics</span>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-slate-800/90 text-slate-300 border border-slate-700/60">#Traceability</span>
              </div>
            </div>

            <!-- Footer Belakang -->
            <div class="pt-3 border-t border-slate-800 relative z-10 flex items-center justify-between text-xs">
              <span class="text-[11px] text-slate-400 flex items-center gap-1 font-medium truncate max-w-[170px]">
                <i data-lucide="check-circle-2" class="w-3.5 h-3.5 shrink-0 text-[#F36E25]"></i>
                <span class="truncate">Digitalisasi Rantai Pasok Balik</span>
              </span>
              <span class="text-[11px] font-bold text-slate-200 hover:text-white flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 transition-colors shrink-0">
                <span>Kembali</span>
                <i data-lucide="rotate-cw" class="w-3 h-3"></i>
              </span>
            </div>
          </div>

        </div>
      </div>

    </div>
    </section>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
        <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-xs font-medium">Total Sebaran</span>
                <i data-lucide="package" class="w-4 h-4 text-emerald-500"></i>
            </div>
            <div class="text-2xl font-black text-slate-800">{{ number_format($totalSebaran, 0, ',', '.') }}</div>
            <div class="text-[11px] text-emerald-600 flex items-center gap-1 mt-1 font-semibold">
                <span>●</span> 100% Produk Daur Ulang
            </div>
        </div>
        <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-xs font-medium">Wilayah Terbanyak</span>
                <i data-lucide="trending-up" class="w-4 h-4 text-emerald-500"></i>
            </div>
            <div class="text-2xl font-black text-slate-800">{{ $topRegion['nama'] }}</div>
            <div class="text-[11px] text-emerald-600 mt-1 font-semibold">
                <span>{{ $topRegion['jumlah'] }} Produk ({{ number_format(($topRegion['jumlah'] / $totalSebaran) * 100, 1) }}%)</span>
            </div>
        </div>
        <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-xs font-medium">Cakupan Wilayah</span>
                <i data-lucide="map-pin" class="w-4 h-4 text-sky-500"></i>
            </div>
            <div class="text-2xl font-black text-slate-800">{{ count($dataSebaran) }} Daerah</div>
            <div class="text-[11px] text-sky-600 mt-1 font-semibold">Sumatera s/d Papua</div>
        </div>
        <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between text-slate-500 mb-1">
                <span class="text-xs font-medium">Jangkauan Ekspor</span>
                <i data-lucide="globe" class="w-4 h-4 text-sky-500"></i>
            </div>
            <div class="text-2xl font-black text-slate-800">{{ count($internasional) }} Negara</div>
            <div class="text-[11px] text-sky-600 mt-1 font-semibold line-clamp-1">
                @foreach($internasional as $intl) {{ $intl['kode'] }}@if(!$loop->last), @endif @endforeach
            </div>
        </div>
    </div>

        <!-- MAP CONTAINER & CONTROLS -->
        <div class="rounded-3xl bg-white border border-slate-200 shadow-lg overflow-hidden relative mt-6">
            <!-- Controls Toolbar -->
            <div class="px-5 py-3.5 border-b border-slate-200 bg-slate-50 flex flex-wrap items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-1 bg-white p-1 rounded-xl border border-slate-200 shadow-sm">
                    <button onclick="setFilter('all')" id="btn-filter-all" class="filter-btn px-3 py-1.5 rounded-lg font-semibold transition bg-gradient-to-r from-emerald-500 to-sky-500 text-white">Semua</button>
                    <button onclick="setFilter('jakarta')" id="btn-filter-jakarta" class="filter-btn px-3 py-1.5 rounded-lg text-slate-500 hover:bg-slate-100 transition font-medium"><span class="inline-block w-2 h-2 rounded-full bg-emerald-500 mr-1.5"></span>Hub Hijau</button>
                    <button onclick="setFilter('surabaya')" id="btn-filter-surabaya" class="filter-btn px-3 py-1.5 rounded-lg text-slate-500 hover:bg-slate-100 transition font-medium"><span class="inline-block w-2 h-2 rounded-full bg-sky-500 mr-1.5"></span>Hub Biru</button>
                    <button onclick="setFilter('intl')" id="btn-filter-intl" class="filter-btn px-3 py-1.5 rounded-lg text-slate-500 hover:bg-slate-100 transition font-medium">✈️ Internasional</button>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="toggleAnimation()" class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 flex items-center gap-1.5 shadow-sm"><i data-lucide="pause" id="play-pause-icon" class="w-3.5 h-3.5 text-emerald-500"></i><span id="play-pause-text" class="font-semibold">Pause</span></button>
                    <div class="flex items-center gap-1 bg-white border border-slate-200 px-2 py-1 rounded-xl text-slate-500 shadow-sm">
                        <button onclick="setSpeed(2.2)" id="speed-slow" class="speed-btn px-2 py-0.5 rounded text-[11px] font-medium">0.5x</button>
                        <button onclick="setSpeed(1.4)" id="speed-normal" class="speed-btn px-2 py-0.5 rounded text-[11px] bg-slate-800 text-white font-bold">1x</button>
                        <button onclick="setSpeed(0.8)" id="speed-fast" class="speed-btn px-2 py-0.5 rounded text-[11px] font-medium">2x</button>
                    </div>
                </div>
            </div>

            <!-- SVG MAP AREA -->
            <div class="relative w-full aspect-[1200/580] bg-slate-50 flex items-center justify-center overflow-hidden" id="map-viewport">
                <!-- Tooltip (Udah Diganti Warna Terang) -->
                <div id="map-tooltip"
                    class="absolute pointer-events-none opacity-0 transition-opacity duration-150 z-[100] bg-white/95 backdrop-blur border border-slate-200 px-4 py-2.5 rounded-xl shadow-xl text-xs -translate-x-1/2 -translate-y-[120%] min-w-[150px]"
                    style="will-change: transform, opacity; top: 0; left: 0;">

                    <div id="tooltip-title" class="font-bold text-slate-800 text-sm"></div>
                    <div id="tooltip-count" class="text-emerald-600 font-extrabold text-base mt-0.5"></div>
                    <div id="tooltip-sub" class="text-[11px] text-slate-500 mt-1"></div>
                </div>

                <svg viewBox="0 0 1200 580" class="w-full h-full select-none" id="persebaran-svg">
                  <defs>
                      <filter id="glowGreen" x="-20%" y="-20%" width="140%" height="140%">
                          <feGaussianBlur stdDeviation="2.5" result="blur" />
                          <feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge>
                      </filter>
                      <filter id="glowBlue" x="-20%" y="-20%" width="140%" height="140%">
                          <feGaussianBlur stdDeviation="2.5" result="blur" />
                          <feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge>
                      </filter>
                      <g id="airplane-icon"><path d="M -6 -4 L 6 0 L -6 4 L -4 0 Z" fill="#0284c7" stroke="#ffffff" stroke-width="0.8" /></g>
                  </defs>

                  <g stroke="#cbd5e1" stroke-width="0.6" stroke-dasharray="3,4" opacity="0.6" class="pointer-events-none">
                      <line x1="0" y1="140" x2="1200" y2="140" /><line x1="0" y1="280" x2="1200" y2="280" /><line x1="0" y1="420" x2="1200" y2="420" />
                      <line x1="250" y1="0" x2="250" y2="580" /><line x1="500" y1="0" x2="500" y2="580" /><line x1="750" y1="0" x2="750" y2="580" /><line x1="1000" y1="0" x2="1000" y2="580" />
                  </g>

                  <g id="islands-group" class="transition-opacity duration-300 pointer-events-none"
                    fill="#e2e8f0" fill-opacity="0.8" stroke="#cbd5e1" stroke-opacity="0.9" stroke-width="1.2" stroke-linejoin="round">
                          <path d="M 55 135 C 63.7 133, 84.2 137.5, 100 148 C 115.8 158.5, 132.5 181, 150 198 C 167.5 215, 188.3 233, 205 250 C 221.7 267, 236.7 281.7, 250 300 C 263.3 318.3, 276.7 340, 285 360 C 293.3 380, 297.8 405.3, 300 420 C 302.2 434.7, 299.7 440.3, 298 448 C 296.3 455.7, 294.3 462.3, 290 466 C 285.7 469.7, 277.8 473.3, 272 470 C 266.2 466.7, 266.2 460, 255 446 C 243.8 432, 222.5 406.7, 205 386 C 187.5 365.3, 166.7 343.7, 150 322 C 133.3 300.3, 118.7 276.7, 105 256 C 91.3 235.3, 77.5 214, 68 198 C 58.5 182, 50.2 170.5, 48 160 C 45.8 149.5, 46.3 137, 55 135 Z" />
                          <path d="M 302 466 C 302 462, 304.8 458, 312 456 C 319.2 454, 333.7 453, 345 454 C 356.3 455, 367.5 459.3, 380 462 C 392.5 464.7, 406.7 467.7, 420 470 C 433.3 472.3, 446.7 474, 460 476 C 473.3 478, 487.5 480, 500 482 C 512.5 484, 526.3 486, 535 488 C 543.7 490, 549.2 491.7, 552 494 C 554.8 496.3, 555.7 499, 552 502 C 548.3 505, 538.7 509.3, 530 512 C 521.3 514.7, 510.8 516, 500 518 C 489.2 520, 476.7 523.3, 465 524 C 453.3 524.7, 441.7 523.3, 430 522 C 418.3 520.7, 405.8 518.3, 395 516 C 384.2 513.7, 375 512, 365 508 C 355 504, 343.8 496.7, 335 492 C 326.2 487.3, 317.5 484.3, 312 480 C 306.5 475.7, 302 470, 302 466 Z" />
                          <path d="M 385 300 C 385.8 287.5, 390.8 270.8, 400 260 C 409.2 249.2, 423.3 242.5, 440 235 C 456.7 227.5, 480 220.8, 500 215 C 520 209.2, 544.2 200.8, 560 200 C 575.8 199.2, 588.3 202.5, 595 210 C 601.7 217.5, 600.8 232.5, 600 245 C 599.2 257.5, 590.8 272.5, 590 285 C 589.2 297.5, 598.3 309.2, 595 320 C 591.7 330.8, 576.7 339.2, 570 350 C 563.3 360.8, 563.3 377, 555 385 C 546.7 393, 532.5 396.8, 520 398 C 507.5 399.2, 493.3 395.8, 480 392 C 466.7 388.2, 450.8 381.2, 440 375 C 429.2 368.8, 422.5 361.7, 415 355 C 407.5 348.3, 400 344.2, 395 335 C 390 325.8, 384.2 312.5, 385 300 Z" />
                          <path d="M 640 305 C 645.8 299.2, 655 295.5, 665 290 C 675 284.5, 688.3 279, 700 272 C 711.7 265, 724.2 254.7, 735 248 C 745.8 241.3, 756.7 234, 765 232 C 773.3 230, 782.5 232.7, 785 236 C 787.5 239.3, 785.8 247.7, 780 252 C 774.2 256.3, 760.8 256.5, 750 262 C 739.2 267.5, 723.8 277.8, 715 285 C 706.2 292.2, 699.5 297.5, 697 305 C 694.5 312.5, 700.8 322.2, 700 330 C 699.2 337.8, 692 342.8, 692 352 C 692 361.2, 700.3 375.3, 700 385 C 699.7 394.7, 693.3 400.8, 690 410 C 686.7 419.2, 685 433, 680 440 C 675 447, 665.8 452, 660 452 C 654.2 452, 648.3 447, 645 440 C 641.7 433, 642.5 419.2, 640 410 C 637.5 400.8, 631.3 395, 630 385 C 628.7 375, 632 360, 632 350 C 632 340, 628.7 332.5, 630 325 C 631.3 317.5, 634.2 310.8, 640 305 Z" />
                          <path d="M 975 372 C 977 365.7, 982.5 356.5, 990 352 C 997.5 347.5, 1010 344, 1020 345 C 1030 346, 1039.2 356.8, 1050 358 C 1060.8 359.2, 1071.7 353.7, 1085 352 C 1098.3 350.3, 1115.8 346.3, 1130 348 C 1144.2 349.7, 1160.8 355, 1170 362 C 1179.2 369, 1185 380.3, 1185 390 C 1185 399.7, 1177.5 413, 1170 420 C 1162.5 427, 1151.7 431.2, 1140 432 C 1128.3 432.8, 1111.7 423.7, 1100 425 C 1088.3 426.3, 1080 440, 1070 440 C 1060 440, 1048.3 430.8, 1040 425 C 1031.7 419.2, 1027.5 408.8, 1020 405 C 1012.5 401.2, 1002 404.5, 995 402 C 988 399.5, 981.3 395, 978 390 C 974.7 385, 973 378.3, 975 372 Z" />
                          <path d="M 241 255 C 241.3 252.5, 246.5 249, 250 248 C 253.5 247, 258.7 247.7, 262 249 C 265.3 250.3, 270 253.7, 270 256 C 270 258.3, 265.7 261.8, 262 263 C 258.3 264.2, 251.5 264.3, 248 263 C 244.5 261.7, 240.7 257.5, 241 255 Z" />
                          <path d="M 561 511 C 561 508.5, 564.7 504.2, 568 503 C 571.3 501.8, 577.3 502.7, 581 504 C 584.7 505.3, 589.8 508.8, 590 511 C 590.2 513.2, 585.7 515.8, 582 517 C 578.3 518.2, 571.5 519, 568 518 C 564.5 517, 561 513.5, 561 511 Z" />
                          <path d="M 596 516 C 595.2 513.5, 601.7 509.5, 607 508 C 612.3 506.5, 620.5 506.5, 628 507 C 635.5 507.5, 647 509.2, 652 511 C 657 512.8, 660 515.8, 658 518 C 656 520.2, 647.7 523.2, 640 524 C 632.3 524.8, 619.3 524.3, 612 523 C 604.7 521.7, 596.8 518.5, 596 516 Z" />
                          <path d="M 683 531 C 682.5 528.3, 690 524.5, 697 523 C 704 521.5, 714.5 521.7, 725 522 C 735.5 522.3, 750.5 523.5, 760 525 C 769.5 526.5, 780.3 528.7, 782 531 C 783.7 533.3, 777.8 537.5, 770 539 C 762.2 540.5, 746.7 540, 735 540 C 723.3 540, 708.7 540.5, 700 539 C 691.3 537.5, 683.5 533.7, 683 531 Z" />
                          <path d="M 800 548 C 801.7 545.5, 810.5 542.3, 818 541 C 825.5 539.7, 836.7 539.3, 845 540 C 853.3 540.7, 865.8 542.8, 868 545 C 870.2 547.2, 864.3 551.2, 858 553 C 851.7 554.8, 838.3 555.5, 830 556 C 821.7 556.5, 813 557.3, 808 556 C 803 554.7, 798.3 550.5, 800 548 Z" />
                          <path d="M 862 385 C 860.7 380.8, 867 375.3, 872 373 C 877 370.7, 886 369.8, 892 371 C 898 372.2, 906.2 376.2, 908 380 C 909.8 383.8, 907.7 391, 903 394 C 898.3 397, 886.8 399.5, 880 398 C 873.2 396.5, 863.3 389.2, 862 385 Z" />
                          <path d="M 922 403 C 921.5 400.7, 928.3 397.7, 932 397 C 935.7 396.3, 941.7 397.3, 944 399 C 946.3 400.7, 947.5 405, 946 407 C 944.5 409, 939 411.7, 935 411 C 931 410.3, 922.5 405.3, 922 403 Z" />
                          <path d="M 314 384 C 315 380.7, 321.8 377.7, 326 378 C 330.2 378.3, 337.5 382.7, 339 386 C 340.5 389.3, 338.2 396, 335 398 C 331.8 400, 323.5 400.3, 320 398 C 316.5 395.7, 313 387.3, 314 384 Z" />
                  </g>

                  <g id="routes-layer" class="pointer-events-none"></g>

                  <g id="markers-layer"></g>
              </svg>
            </div>

            <div class="px-6 py-3.5 bg-white border-t border-slate-200 flex justify-between text-xs">
                <div class="flex gap-5">
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-emerald-500"></span><span class="text-slate-600 font-semibold">Hub Utama (Jakarta)</span></div>
                    <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-sky-500"></span><span class="text-slate-600 font-semibold">Sub-Hub (Surabaya)</span></div>
                </div>
            </div>
        </div>

        <!-- TABLE SECTION -->
        <div class="rounded-3xl bg-white border border-slate-200 p-6 space-y-5 shadow-sm mt-6">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <h2 class="text-lg font-bold text-slate-800"><span class="text-emerald-500">📋</span> Tabel Penyebaran Produk</h2>
                <input type="text" id="search-province" onkeyup="filterTable()" placeholder="Cari wilayah..." class="w-full sm:w-64 px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-3" id="table-grid-container">
                <!-- Rendered by JS -->
            </div>
        </div>

    <!-- 2 Columns: Penghargaan vs Kepercayaan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-4">
            <h2 class="font-extrabold text-lg text-slate-900">Semua Penghargaan yang Diterima</h2>

            <div class="space-y-3">
                @forelse($certificates as $certificate)
                    <div class="pb-card flex items-center justify-between p-4 bg-white rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-2xl flex-shrink-0">
                                🏆
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-slate-900">{{ $certificate->nama }}</h3>
                                <p class="text-xs text-slate-500">{{ $certificate->penyelenggara }} · {{ $certificate->tahun }}</p>
                            </div>
                        </div>
                        <a href="{{ route('certificates.show', $certificate->id) }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition">
                            Lihat Dokumen ›
                        </a>
                    </div>
                @empty
                    <div class="text-center py-10 bg-white rounded-2xl border border-dashed border-slate-300">
                        <span class="text-4xl block mb-2">📜</span>
                        <p class="text-sm text-slate-500 font-medium">Belum ada penghargaan yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="font-extrabold text-lg text-slate-900">Kenapa Percaya Kami?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div class="pb-card p-4 space-y-2">
                    <span class="text-2xl">📄</span>
                    <h3 class="font-bold text-xs text-slate-900">Legalitas Usaha Resmi</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">NIB & izin edar usaha lengkap terverifikasi pemerintah.</p>
                </div>
                <div class="pb-card p-4 space-y-2">
                    <span class="text-2xl">🔍</span>
                    <h3 class="font-bold text-xs text-slate-900">Proses Transparan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Dokumentasi foto & video tiap tahap pengolahan terbuka untuk umum.</p>
                </div>
                <div class="pb-card p-4 space-y-2">
                    <span class="text-2xl">📊</span>
                    <h3 class="font-bold text-xs text-slate-900">Laporan Dampak Bulanan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Statistik kilogram sampah terolah dipublikasikan setiap akhir bulan.</p>
                </div>
                <div class="pb-card p-4 space-y-2">
                    <span class="text-2xl">🛡️</span>
                    <h3 class="font-bold text-xs text-slate-900">Garansi & Kontrol Mutu</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Retur 7 hari jika ditemukan cacat produksi jahitan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // ==========================================
        // 1. FUNGSI UNTUK SDGS (KARTU 3D)
        // ==========================================
        let isAllFlipped = false;

        function toggleCard(cardElement) {
            cardElement.classList.toggle('is-flipped');
        }

        function toggleFlipAll() {
            isAllFlipped = !isAllFlipped;
            const allCards = document.querySelectorAll('.flip-card-inner');
            allCards.forEach(card => {
                isAllFlipped ? card.classList.add('is-flipped') : card.classList.remove('is-flipped');
            });
            const btnText = document.getElementById('btn-flip-all-text');
            if(btnText) btnText.textContent = isAllFlipped ? 'Tampilkan Bagian Depan (Reset)' : 'Putar Semua Kartu';
        }

        // ==========================================
        // 2. FUNGSI UNTUK PETA PERSEBARAN
        // ==========================================
        const sebaranData  = @json($dataSebaran);
        const originRaw    = @json($originHub);
        const intlData     = @json($internasional);
        const totalSebaran = {{ $totalSebaran }};

        let currentFilter = 'all';
        let isAnimationPlaying = true;
        let currentSpeed = 1.4;

        const SVG_NS = 'http://www.w3.org/2000/svg';
        const MAP_W = 1200, MAP_H = 580;

        // ==========================================
        // 2. HUB = YOGYAKARTA
        // ==========================================
        // Dibuat toleran: bisa terima $originHub berbentuk {x,y,...}, {yogyakarta:{...}},
        // atau array berisi item kode 'yogyakarta'. Kalau datanya kosong/rusak, pakai koordinat default.
        const DEFAULT_ORIGIN = { kode: 'yogyakarta', nama: 'Yogyakarta', jumlah: 0, x: 465, y: 512 };

        function resolveOrigin(raw) {
            let o = raw;
            if (Array.isArray(o)) o = o.find(h => h && h.kode === 'yogyakarta') || o[0];
            else if (o && o.yogyakarta) o = o.yogyakarta;
            o = o || {};

            const fromList = (sebaranData || []).find(i => i.kode === 'yogyakarta') || {};
            const x = Number(o.x), y = Number(o.y);

            return {
                ...DEFAULT_ORIGIN, ...fromList, ...o,
                x: Number.isFinite(x) ? x : DEFAULT_ORIGIN.x,
                y: Number.isFinite(y) ? y : DEFAULT_ORIGIN.y,
            };
        }
        const ORIGIN = resolveOrigin(originRaw);

        const isOrigin = (item) => item.is_origin || item.kode === 'yogyakarta';

        // Kunci grup warna. Nama 'jakarta' / 'surabaya' dipertahankan supaya tombol filter di HTML tidak perlu diubah:
        // 'jakarta' = jalur hijau (barat), 'surabaya' = jalur biru (timur).
        function getGroup(item) {
            if (item.alur) return item.alur === 'biru' ? 'surabaya' : 'jakarta';
            return item.hub === 'surabaya' ? 'surabaya' : 'jakarta';
        }

        // ==========================================
        // 3. HELPER KURVA
        // ==========================================
        function createCurvePath(x1, y1, x2, y2, curvature = 0.22) {
            x1 = +x1; y1 = +y1; x2 = +x2; y2 = +y2;
            const mx = (x1 + x2) / 2, my = (y1 + y2) / 2, dx = x2 - x1, dy = y2 - y1;
            const dist = Math.sqrt(dx * dx + dy * dy);
            const cx = mx - (dy / (dist || 1)) * (dist * 0.12);
            const cy = Math.max(30, my - Math.abs(dist * curvature));
            return `M ${x1} ${y1} Q ${cx.toFixed(1)} ${cy.toFixed(1)} ${x2} ${y2}`;
        }

        // ==========================================
        // 4. RENDER PETA
        // ==========================================
        function renderMap() {
            const routesLayer = document.getElementById('routes-layer');
            const markersLayer = document.getElementById('markers-layer');
            routesLayer.innerHTML = '';
            markersLayer.innerHTML = '';

            // --- Domestik: semua rute berangkat dari Yogyakarta ---
            sebaranData.forEach(item => {
                if (isOrigin(item)) return; // Yogyakarta digambar terpisah sebagai hub di bawah

                const group = getGroup(item);
                const isGreen = group === 'jakarta';
                const color = isGreen ? '#10b981' : '#0ea5e9';
                const animClass = isGreen ? 'animate-flow-green' : 'animate-flow-blue';
                const curveD = createCurvePath(ORIGIN.x, ORIGIN.y, item.x, item.y);
                const dur = (1.5 + Math.random() * 1.2).toFixed(2);

                const route = document.createElementNS(SVG_NS, 'g');
                route.className.baseVal = `route-item route-hub-${group}`;
                route.innerHTML = `
                    <path d="${curveD}" fill="none" stroke="${color}" stroke-width="1.8" class="${animClass}" opacity="0.75" />
                    <circle r="2.8" fill="${color}"><animateMotion dur="${dur}s" repeatCount="indefinite" path="${curveD}" /></circle>`;
                routesLayer.appendChild(route);

                const marker = document.createElementNS(SVG_NS, 'g');
                marker.className.baseVal = `node-point marker-item marker-hub-${group}`;
                marker.id = `marker-${item.kode}`;
                marker.setAttribute('transform', `translate(${item.x}, ${item.y})`);

                // rect transparan = area hover yang STATIS (tidak ikut membesar/bergeser)
                marker.innerHTML = `
                    <rect x="-14" y="-20" width="28" height="40" fill="transparent" />
                    <g class="node-inner">
                        <circle r="4.5" fill="${color}" stroke="#fff" stroke-width="1.5" />
                        <rect x="-13" y="-18" width="26" height="12" rx="4" fill="rgba(255,255,255,0.95)" stroke="${color}" stroke-width="1" />
                        <text y="-9" text-anchor="middle" fill="#0f172a" font-size="8.5" font-weight="800">${item.mapCount ?? item.jumlah}</text>
                        <text y="15" text-anchor="middle" fill="#475569" font-size="9" font-weight="600">${item.nama}</text>
                    </g>`;

                marker.addEventListener('mouseenter', () => showTooltip(item));
                marker.addEventListener('mouseleave', hideTooltip);
                marker.addEventListener('click', () => highlightRegion(item.kode));
                markersLayer.appendChild(marker);
            });

            // --- Internasional: juga dari Yogyakarta ---
            intlData.forEach(intl => {
                const curveD = createCurvePath(ORIGIN.x, ORIGIN.y, intl.x, intl.y, 0.38);

                const intlRoute = document.createElementNS(SVG_NS, 'g');
                intlRoute.className.baseVal = 'route-item route-intl';
                intlRoute.innerHTML = `
                    <path d="${curveD}" fill="none" stroke="#0ea5e9" stroke-width="1.8" stroke-dasharray="5 5" class="animate-flow-blue" opacity="0.85" />
                    <use href="#airplane-icon"><animateMotion dur="3.8s" repeatCount="indefinite" rotate="auto" path="${curveD}" /></use>`;
                routesLayer.appendChild(intlRoute);

                const intlMarker = document.createElementNS(SVG_NS, 'g');
                intlMarker.className.baseVal = 'node-point marker-item marker-intl';
                intlMarker.setAttribute('transform', `translate(${intl.x}, ${intl.y})`);
                intlMarker.innerHTML = `
                    <rect x="-30" y="-12" width="60" height="38" fill="transparent" />
                    <g class="node-inner">
                        <circle r="5.5" fill="#0ea5e9" stroke="#fff" stroke-width="1.8" />
                        <text y="18" text-anchor="middle" fill="#0284c7" font-size="10.5" font-weight="800">${String(intl.negara).toUpperCase()}</text>
                    </g>`;

                intlMarker.addEventListener('mouseenter', () => showTooltip({
                    nama: `Ekspor Internasional: ${intl.negara}`,
                    jumlah: 'Jalur Ekspor',
                    pulau: 'Global Logistics',
                    x: intl.x, y: intl.y
                }));
                intlMarker.addEventListener('mouseleave', hideTooltip);
                markersLayer.appendChild(intlMarker);
            });

            // --- Hub Yogyakarta (digambar paling akhir supaya ada di atas) ---
            const hub = document.createElementNS(SVG_NS, 'g');
            hub.className.baseVal = 'node-point marker-item marker-origin';
            hub.id = 'marker-yogyakarta';
            hub.setAttribute('transform', `translate(${ORIGIN.x}, ${ORIGIN.y})`);
            hub.innerHTML = `
                <circle class="radar-wave-1" cx="0" cy="0" fill="none" stroke="#10b981" />
                <circle class="radar-wave-2" cx="0" cy="0" fill="none" stroke="#0ea5e9" />
                <rect x="-18" y="-28" width="36" height="42" fill="transparent" />
                <g class="node-inner">
                    <circle r="9.5" fill="#059669" stroke="#ffffff" stroke-width="2.5" filter="url(#glowGreen)" />
                    <circle r="3.5" fill="#ffffff" />
                    <rect x="-18" y="-25" width="36" height="15" rx="7.5" fill="#059669" stroke="#ffffff" stroke-width="1.2" />
                    <text y="-14.5" text-anchor="middle" fill="#ffffff" font-size="9" font-weight="900">${ORIGIN.jumlah ?? ''}</text>
                </g>
                <g transform="translate(0, 24)" pointer-events="none">
                    <rect x="-65" y="-9" width="130" height="18" rx="9" fill="#1b4317" />
                    <text text-anchor="middle" y="3.5" fill="#ffffff" font-size="8.5" font-weight="900" letter-spacing="0.5">★ PUSAT DISTRIBUSI: JOGJA</text>
                </g>`;

            hub.addEventListener('mouseenter', () => showTooltip({
                nama: 'D.I. Yogyakarta (Pusat Distribusi)',
                jumlah: ORIGIN.jumlah,
                pulau: 'Pusat Rumah Produksi & Gudang Utama',
                x: ORIGIN.x, y: ORIGIN.y
            }));
            hub.addEventListener('mouseleave', hideTooltip);
            hub.addEventListener('click', () => highlightRegion('yogyakarta'));
            markersLayer.appendChild(hub);
        }

        // ==========================================
        // 5. TABEL
        // ==========================================
        function renderTable() {
            const container = document.getElementById('table-grid-container');
            let html = '';
            sebaranData.forEach(item => {
                const isGreen = getGroup(item) === 'jakarta';
                const origin = isOrigin(item);
                html += `
                    <div id="card-${item.kode}" class="table-card p-2.5 rounded-xl bg-white border ${origin ? 'border-emerald-500 ring-2 ring-emerald-500/30' : 'border-slate-200'} hover:border-emerald-400 hover:shadow-md cursor-pointer flex justify-between items-center transition" onclick="highlightRegion('${item.kode}')">
                        <div class="flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md ${origin ? 'bg-emerald-600 text-white' : (isGreen ? 'bg-emerald-100 text-emerald-600' : 'bg-sky-100 text-sky-600')} flex items-center justify-center text-[10px] font-bold">${item.no}</span>
                            <span class="font-semibold text-xs text-slate-700">${item.nama} ${origin ? '📍' : ''}</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-md ${origin ? 'bg-emerald-600 text-white' : (isGreen ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-sky-50 text-sky-600 border border-sky-100')} text-xs font-bold">${item.jumlah}</span>
                    </div>`;
            });
            container.innerHTML = html;
        }

        // ==========================================
        // 6. TOOLTIP (diposisikan di node, bukan di kursor -> tidak goyang)
        // ==========================================
        function showTooltip(data) {
            const t = document.getElementById('map-tooltip');
            const rect = document.getElementById('map-viewport').getBoundingClientRect();

            document.getElementById('tooltip-title').textContent = data.nama || 'Tidak diketahui';
            document.getElementById('tooltip-count').textContent =
                typeof data.jumlah === 'number' ? `${data.jumlah} Produk` : (data.jumlah ?? '0 Produk');
            document.getElementById('tooltip-sub').textContent = data.pulau || 'Indonesia';

            // Hitung posisi dari koordinat SVG node (viewBox 1200x580)
            const px = (Number(data.x) / MAP_W) * rect.width;
            const py = (Number(data.y) / MAP_H) * rect.height;

            t.style.left = `${px}px`;
            t.style.top = `${py - 14}px`;
            t.style.opacity = '1';
        }

        function hideTooltip() { document.getElementById('map-tooltip').style.opacity = '0'; }

        // ==========================================
        // 7. HIGHLIGHT, FILTER, KONTROL
        // ==========================================
        function highlightRegion(kode) {
            document.querySelectorAll('.table-card').forEach(c => {
                c.classList.remove('ring-2', 'ring-emerald-500', 'bg-slate-50');
            });

            const card = document.getElementById(`card-${kode}`);
            if (card) {
                card.classList.add('ring-2', 'ring-emerald-500', 'bg-slate-50');
                card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            // Animasikan elemen dalam (.node-inner), bukan <g> yang punya translate()
            const inner = document.querySelector(`#marker-${kode} .node-inner`);
            if (inner) {
                inner.animate(
                    [{ transform: 'scale(1)' }, { transform: 'scale(1.8)' }, { transform: 'scale(1)' }],
                    { duration: 600, easing: 'ease-in-out' }
                );
            }
        }

        function setFilter(filter) {
            currentFilter = filter;

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-sky-500', 'text-white', 'font-semibold');
                btn.classList.add('text-slate-500');
            });
            const activeBtn = document.getElementById(`btn-filter-${filter}`);
            if (activeBtn) {
                activeBtn.classList.remove('text-slate-500');
                activeBtn.classList.add('bg-gradient-to-r', 'from-emerald-500', 'to-sky-500', 'text-white', 'font-semibold');
            }

            document.querySelectorAll('.route-item').forEach(r => {
                const show = filter === 'all'
                    || r.classList.contains(`route-hub-${filter}`)
                    || (filter === 'intl' && r.classList.contains('route-intl'));
                r.style.display = show ? 'block' : 'none';
            });

            document.querySelectorAll('.marker-item').forEach(m => {
                const show = filter === 'all'
                    || m.classList.contains('marker-origin') // hub Yogyakarta selalu terlihat
                    || m.classList.contains(`marker-hub-${filter}`)
                    || (filter === 'intl' && m.classList.contains('marker-intl'));
                m.style.opacity = show ? '1' : '0.25';
            });
        }

        function filterTable() {
            const query = document.getElementById('search-province').value.toLowerCase();
            document.querySelectorAll('.table-card').forEach(c => {
                c.style.display = c.textContent.toLowerCase().includes(query) ? 'flex' : 'none';
            });
        }

        function setSpeed(speed) {
            currentSpeed = speed;
            document.documentElement.style.setProperty('--anim-speed', `${speed}s`);

            document.querySelectorAll('.speed-btn').forEach(btn => {
                btn.classList.remove('bg-slate-800', 'text-white', 'font-bold');
                btn.classList.add('text-slate-500');
            });

            const activeId = speed === 2.2 ? 'speed-slow' : speed === 1.4 ? 'speed-normal' : 'speed-fast';
            const activeBtn = document.getElementById(activeId);
            if (activeBtn) {
                activeBtn.classList.remove('text-slate-500');
                activeBtn.classList.add('bg-slate-800', 'text-white', 'font-bold');
            }
        }

        function toggleAnimation() {
            const svg = document.getElementById('persebaran-svg');
            const icon = document.getElementById('play-pause-icon');
            const text = document.getElementById('play-pause-text');

            isAnimationPlaying = !isAnimationPlaying;
            if (isAnimationPlaying) {
                svg.unpauseAnimations();
                document.documentElement.style.setProperty('--anim-speed', `${currentSpeed}s`);
                icon.setAttribute('data-lucide', 'pause');
                text.textContent = 'Pause';
            } else {
                svg.pauseAnimations();
                icon.setAttribute('data-lucide', 'play');
                text.textContent = 'Play';
            }
            lucide.createIcons();
        }

        // ==========================================
        // 8. JALANKAN SAAT HALAMAN DIBUKA
        // ==========================================
        document.addEventListener('DOMContentLoaded', () => {
            renderMap();
            renderTable();
            lucide.createIcons();
        });
    </script>
@endpush
