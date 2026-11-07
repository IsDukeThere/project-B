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
        .radar-wave-1 { animation: radarPulse 2.6s cubic-bezier(0.2, 0.8, 0.4, 1) infinite; }
        .radar-wave-2 { animation: radarPulse 2.6s cubic-bezier(0.2, 0.8, 0.4, 1) infinite; animation-delay: 1.3s; }
        /* Point Glow Hover */
        .node-point { cursor: pointer; transition: transform 0.25s ease; }
        .node-point:hover { transform: scale(1.2); }
        /* Custom Scrollbar */
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
                <div id="map-tooltip" class="absolute pointer-events-none opacity-0 transition-opacity z-50 bg-white/95 backdrop-blur border border-slate-200 px-4 py-2.5 rounded-xl shadow-xl text-xs -translate-x-1/2 -translate-y-full mb-3 min-w-[150px]">
                    <div id="tooltip-title" class="font-bold text-slate-800 text-sm"></div>
                    <div id="tooltip-count" class="text-emerald-600 font-extrabold text-base mt-0.5"></div>
                    <div id="tooltip-sub" class="text-[11px] text-slate-500 mt-1"></div>
                </div>

                <svg viewBox="0 0 1200 580" class="w-full h-full select-none" id="persebaran-svg">
                    <defs>
                        <filter id="glowGreen" x="-50%" y="-50%" width="200%" height="200%"><feGaussianBlur stdDeviation="3.5" result="blur" /><feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge></filter>
                        <filter id="glowBlue" x="-50%" y="-50%" width="200%" height="200%"><feGaussianBlur stdDeviation="3.5" result="blur" /><feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge></filter>
                        <g id="airplane-icon"><path d="M -6 -4 L 6 0 L -6 4 L -4 0 Z" fill="#0284c7" stroke="#ffffff" stroke-width="0.8" /></g>
                    </defs>
                    
                    <!-- Grid Lines Terang -->
                    <g stroke="#cbd5e1" stroke-width="0.6" stroke-dasharray="3,4" opacity="0.6">
                        <line x1="0" y1="140" x2="1200" y2="140" /><line x1="0" y1="280" x2="1200" y2="280" /><line x1="0" y1="420" x2="1200" y2="420" />
                        <line x1="250" y1="0" x2="250" y2="580" /><line x1="500" y1="0" x2="500" y2="580" /><line x1="750" y1="0" x2="750" y2="580" /><line x1="1000" y1="0" x2="1000" y2="580" />
                    </g>

                    <!-- SILUET PULAU TERANG -->
                    <g id="islands-group" class="transition-opacity duration-300">
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 65 140 C 85 125, 110 145, 125 170 C 150 210, 175 250, 205 295 C 230 330, 255 375, 275 425 C 290 455, 295 478, 280 485 C 265 488, 250 465, 235 435 C 210 390, 180 340, 150 295 C 125 255, 95 215, 75 180 C 60 155, 55 145, 65 140 Z" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 305 470 C 325 465, 355 465, 385 480 C 415 490, 445 490, 475 495 C 505 495, 535 490, 565 510 C 565 520, 545 525, 515 520 C 475 520, 445 520, 405 515 C 365 510, 325 500, 300 485 C 295 475, 300 470, 305 470 Z" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 395 320 C 410 270, 450 240, 500 240 C 540 240, 570 220, 585 230 C 595 250, 575 280, 565 310 C 575 335, 570 365, 555 390 C 540 405, 515 405, 495 400 C 470 395, 445 390, 425 380 C 400 370, 385 345, 395 320 Z" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 625 375 C 630 345, 650 320, 665 300 C 675 275, 695 250, 725 235 C 730 245, 710 265, 695 285 C 690 310, 680 330, 690 355 C 705 380, 715 405, 705 425 C 690 430, 680 410, 665 390 C 655 390, 650 420, 640 450 C 630 455, 625 430, 630 405 C 620 395, 620 385, 625 375 Z" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 760 230 C 775 225, 785 240, 775 260 C 785 275, 775 295, 765 290 C 760 270, 765 255, 760 230 Z" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 860 320 C 885 305, 910 325, 915 345 C 900 360, 875 355, 860 340 C 855 330, 855 325, 860 320 Z" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 915 355 C 950 355, 990 350, 1040 360 C 1065 365, 1070 420, 1065 470 C 1045 480, 1010 470, 975 440 C 950 420, 925 390, 915 355 Z" />
                        <ellipse cx="260" cy="370" rx="12" ry="18" transform="rotate(25 260 370)" class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" />
                        <ellipse cx="290" cy="385" rx="8" ry="10" class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" />
                        <ellipse cx="535" cy="480" rx="20" ry="6" class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" />
                        <ellipse cx="575" cy="515" rx="9" ry="6" class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" />
                        <ellipse cx="605" cy="518" rx="11" ry="7" class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 630 518 C 650 514, 670 516, 675 524 C 665 528, 640 528, 630 518 Z" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 700 520 C 730 516, 755 522, 755 530 C 730 534, 705 532, 700 520 Z" />
                        <path class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" d="M 760 532 C 780 528, 800 536, 795 545 C 775 548, 760 544, 760 532 Z" />
                        <ellipse cx="760" cy="375" rx="12" ry="9" class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" />
                        <ellipse cx="805" cy="370" rx="22" ry="8" class="fill-slate-200/80 stroke-slate-300/80" stroke-width="1.2" />
                    </g>
                    <g id="routes-layer"></g>
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
        const sebaranData = @json($dataSebaran);
        const hubsData = @json($hubs);
        const intlData = @json($internasional);
        const totalSebaran = {{ $totalSebaran }};

        let currentFilter = 'all';
        let isAnimationPlaying = true;
        let currentSpeed = 1.4;

        const nodeCoords = { jakarta: { x: 345, y: 465 }, surabaya: { x: 505, y: 490 } };

        function createCurvePath(x1, y1, x2, y2, curvature = 0.22) {
            const mx = (x1 + x2) / 2, my = (y1 + y2) / 2, dx = x2 - x1, dy = y2 - y1;
            const dist = Math.sqrt(dx * dx + dy * dy);
            const cx = mx - (dy / (dist || 1)) * (dist * curvature * 0.3);
            const cy = my - Math.abs(dist * curvature);
            return `M ${x1} ${y1} Q ${cx.toFixed(1)} ${cy.toFixed(1)} ${x2} ${y2}`;
        }

        function renderMap() {
            const routesLayer = document.getElementById('routes-layer');
            const markersLayer = document.getElementById('markers-layer');
            
            sebaranData.forEach(item => {
                const isHub = item.is_hub;
                const hubId = item.hub || 'jakarta';
                const hub = hubsData[hubId] || nodeCoords[hubId];

                if (!isHub) {
                    const isGreen = hubId === 'jakarta';
                    const color = isGreen ? '#10b981' : '#0ea5e9';
                    const animClass = isGreen ? 'animate-flow-green' : 'animate-flow-blue';
                    const curveD = createCurvePath(hub.x, hub.y, item.x, item.y);
                    const dur = (1.5 + Math.random() * 1.2).toFixed(2);
                    
                    const route = document.createElementNS('http://www.w3.org/2000/svg', 'g');
                    route.className.baseVal = `route-item route-hub-${hubId}`;
                    route.innerHTML = `
                        <path d="${curveD}" fill="none" stroke="${color}" stroke-width="1.8" class="${animClass}" opacity="0.75" />
                        <circle r="2.8" fill="${color}"><animateMotion dur="${dur}s" repeatCount="indefinite" path="${curveD}" /></circle>`;
                    routesLayer.appendChild(route);
                }

                const marker = document.createElementNS('http://www.w3.org/2000/svg', 'g');
                marker.className.baseVal = `node-point marker-item marker-hub-${hubId}`;
                marker.id = `marker-${item.kode}`;
                marker.setAttribute('transform', `translate(${item.x}, ${item.y})`);

                if (isHub) {
                    const isMain = item.hub_type === 'main';
                    const color = isMain ? '#10b981' : '#0ea5e9';
                    marker.innerHTML = `
                        <circle class="radar-wave-1" cx="0" cy="0" fill="none" stroke="${color}" />
                        <circle class="radar-wave-2" cx="0" cy="0" fill="none" stroke="${color}" />
                        <circle r="8.5" fill="${color}" stroke="#fff" stroke-width="2.5" />
                        <text y="-13.5" text-anchor="middle" fill="#0f172a" font-size="9.5" font-weight="900">${item.jumlah}</text>`; // Teks hub jadi gelap
                } else {
                    const color = hubId === 'jakarta' ? '#10b981' : '#0ea5e9';
                    // INI YANG DIUBAH: Kotak putih (rgba 255), tulisan gelap
                    marker.innerHTML = `
                        <circle r="4.5" fill="${color}" stroke="#fff" stroke-width="1.5" />
                        <rect x="-13" y="-18" width="26" height="12" rx="4" fill="rgba(255,255,255,0.95)" stroke="${color}" stroke-width="1" />
                        <text y="-9" text-anchor="middle" fill="#0f172a" font-size="8.5" font-weight="800">${item.jumlah}</text>
                        <text y="15" text-anchor="middle" fill="#475569" font-size="9" font-weight="600">${item.nama}</text>`;
                }

                marker.addEventListener('mouseenter', (e) => showTooltip(e, item));
                marker.addEventListener('mouseleave', hideTooltip);
                marker.addEventListener('click', () => highlightRegion(item.kode));
                markersLayer.appendChild(marker);
            });

            intlData.forEach(intl => {
                const hubId = intl.hub || 'jakarta';
                const hub = hubsData[hubId] || nodeCoords[hubId];
                const curveD = createCurvePath(hub.x, hub.y, intl.x, intl.y, 0.38);

                const intlRoute = document.createElementNS('http://www.w3.org/2000/svg', 'g');
                intlRoute.className.baseVal = `route-item route-intl`;
                intlRoute.innerHTML = `<path d="${curveD}" fill="none" stroke="#0ea5e9" stroke-width="1.8" stroke-dasharray="5 5" class="animate-flow-blue" opacity="0.85" /><use href="#airplane-icon"><animateMotion dur="3.8s" repeatCount="indefinite" rotate="auto" path="${curveD}" /></use>`;
                routesLayer.appendChild(intlRoute);

                const intlMarker = document.createElementNS('http://www.w3.org/2000/svg', 'g');
                intlMarker.className.baseVal = `node-point marker-item marker-intl`;
                intlMarker.setAttribute('transform', `translate(${intl.x}, ${intl.y})`);
                intlMarker.innerHTML = `<circle r="5.5" fill="#0ea5e9" stroke="#fff" stroke-width="1.8" /><text y="18" text-anchor="middle" fill="#0284c7" font-size="10.5" font-weight="800">${intl.negara.toUpperCase()}</text>`;
                markersLayer.appendChild(intlMarker);
            });
        }

        function renderTable() {
            const container = document.getElementById('table-grid-container');
            container.innerHTML = ''; // Kosongkan dulu
            sebaranData.forEach(item => {
                const isGreen = item.hub === 'jakarta';
                container.innerHTML += `
                    <div id="card-${item.kode}" class="table-card p-2.5 rounded-xl bg-white border border-slate-200 hover:border-emerald-400 hover:shadow-md cursor-pointer flex justify-between items-center transition" onclick="highlightRegion('${item.kode}')">
                        <div class="flex items-center gap-2">
                            <span class="w-5 h-5 rounded-md ${isGreen ? 'bg-emerald-100 text-emerald-600' : 'bg-sky-100 text-sky-600'} flex items-center justify-center text-[10px] font-bold">${item.no}</span>
                            <span class="font-semibold text-xs text-slate-700">${item.nama}</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-md ${isGreen ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-sky-50 text-sky-600 border border-sky-100'} text-xs font-bold">${item.jumlah}</span>
                    </div>`;
            });
        }

        function showTooltip(evt, data) {
            const t = document.getElementById('map-tooltip');
            const rect = document.getElementById('map-viewport').getBoundingClientRect();

            document.getElementById('tooltip-title').textContent = data.nama || 'Tidak diketahui';
            document.getElementById('tooltip-count').textContent = (data.jumlah || 0) + ' Produk';
            document.getElementById('tooltip-sub').textContent = data.pulau || 'Indonesia';

            const mouseX = evt.clientX - rect.left;
            const mouseY = evt.clientY - rect.top;

            t.style.left = `${mouseX}px`;
            t.style.top = `${mouseY - 20}px`;
            t.style.opacity = '1';
        }
        
        function hideTooltip() { document.getElementById('map-tooltip').style.opacity = '0'; }
        
        function highlightRegion(kode) {
            document.querySelectorAll('.table-card').forEach(c => {
                c.classList.remove('ring-2', 'ring-emerald-500', 'bg-slate-50');
            });

            const card = document.getElementById(`card-${kode}`);
            if(card) {
                card.classList.add('ring-2', 'ring-emerald-500', 'bg-slate-50');
                card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            const marker = document.getElementById(`marker-${kode}`);
            if (marker) {
                marker.animate([
                    { transform: 'scale(1)' },
                    { transform: 'scale(1.8)' },
                    { transform: 'scale(1)' }
                ], { duration: 600, easing: 'ease-in-out' });
            }
        }
        
        function setFilter(filter) {
            document.querySelectorAll('.route-item').forEach(r => r.style.display = (filter === 'all' || r.classList.contains(`route-hub-${filter}`) || (filter==='intl' && r.classList.contains('route-intl'))) ? 'block' : 'none');
            document.querySelectorAll('.marker-item').forEach(m => m.style.opacity = (filter === 'all' || m.classList.contains(`marker-hub-${filter}`) || m.id === `marker-${filter}` || (filter==='intl' && m.classList.contains('marker-intl'))) ? '1' : '0.25');
        }
        
        function filterTable() {
            const query = document.getElementById('search-province').value.toLowerCase();
            document.querySelectorAll('.table-card').forEach(c => c.style.display = c.textContent.toLowerCase().includes(query) ? 'flex' : 'none');
        }
        
        function setSpeed(speed) { 
            document.documentElement.style.setProperty('--anim-speed', `${speed}s`); 

            document.querySelectorAll('.speed-btn').forEach(btn => {
                btn.classList.remove('bg-slate-800', 'text-white', 'font-bold');
                btn.classList.add('text-slate-500');
            });

            const activeId = speed === 2.2 ? 'speed-slow' : speed === 1.4 ? 'speed-normal' : 'speed-fast';
            const activeBtn = document.getElementById(activeId);
            if(activeBtn) {
                activeBtn.classList.remove('text-slate-500');
                activeBtn.classList.add('bg-slate-800', 'text-white', 'font-bold');
            }
        }
        
        function toggleAnimation() {
            const svg = document.getElementById('persebaran-svg');
            isAnimationPlaying = !isAnimationPlaying;
            isAnimationPlaying ? svg.unpauseAnimations() : svg.pauseAnimations();
        }

        // ==========================================
        // 3. JALANKAN SEMUANYA SAAT HALAMAN DIBUKA
        // ==========================================
        document.addEventListener('DOMContentLoaded', () => { 
            renderMap(); 
            renderTable(); 
            lucide.createIcons();
        });
    </script>
@endpush
