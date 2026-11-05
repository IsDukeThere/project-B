@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="space-y-10">
    <div class="pb-hero-banner">
        <div class="max-w-2xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Penghargaan & Pengakuan</h1>
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
                        <b class="block text-2xl font-extrabold text-emerald-800">2023</b>
                        <span class="text-xs text-slate-500 font-medium">Tahun berdiri</span>
                    </div>
                    <div class="bg-emerald-50 rounded-2xl p-4 text-center border border-emerald-100">
                        <b class="block text-2xl font-extrabold text-emerald-800">12 ton</b>
                        <span class="text-xs text-slate-500 font-medium">Sampah terolah</span>
                    </div>
                    <div class="bg-emerald-50 rounded-2xl p-4 text-center border border-emerald-100">
                        <b class="block text-2xl font-extrabold text-emerald-800">500+</b>
                        <span class="text-xs text-slate-500 font-medium">Warga terlibat</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-4">
                <div class="pb-card p-5 border-l-4 border-l-emerald-600">
                    <h3 class="font-bold text-base text-slate-900 mb-1">Visi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Menjadi mitra terpercaya dalam mewujudkan lingkungan bersih dengan ekonomi sirkular di setiap komunitas Indonesia.
                    </p>
                </div>
                <div class="pb-card p-5 border-l-4 border-l-emerald-600">
                    <h3 class="font-bold text-base text-slate-900 mb-1">Misi</h3>
                    <ul class="mt-2 space-y-1.5 pl-4 list-disc text-xs text-slate-600 leading-relaxed">
                        <li>Mengedukasi masyarakat tentang pemilahan sampah.</li>
                        <li>Mengolah sampah menjadi produk bernilai guna.</li>
                        <li>Menjaga transparansi proses dan laporan dampak.</li>
                        <li>Membangun kemitraan dengan sekolah dan instansi.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SUSTAINABLE DEVELOPMENT GOALS (SDGs) ===== -->
    <section id="sdgs" class="space-y-4">
        <div>
            <div class="text-xs uppercase font-extrabold tracking-wider text-emerald-700">Kontribusi Global</div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">Kontribusi terhadap Sustainable Development Goals (SDGs)</h2>
            <p class="text-sm text-slate-600 max-w-3xl mt-2 leading-relaxed">
                Project B Indonesia berkomitmen mendukung pembangunan berkelanjutan melalui pengelolaan sampah plastik menjadi produk kerajinan bernilai guna, didukung sistem informasi untuk pengelolaan setoran sampah dan penyebaran informasi kepada masyarakat. Kegiatan kami berkontribusi pada empat tujuan berikut.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-2">
            <!-- SDG 11 -->
            <div class="rounded-3xl p-6 text-white flex flex-col justify-between shadow-lg min-h-[300px]" style="background:#FD9D24">
                <div class="space-y-3">
                    <div class="w-16 h-16 border-2 border-white rounded-xl flex flex-col items-center justify-center leading-none">
                        <b class="text-2xl font-extrabold">11</b>
                        <span class="text-[9px] font-bold tracking-widest mt-0.5">SDG</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold uppercase tracking-wide leading-snug">Sustainable Cities and Communities</h3>
                        <em class="not-italic text-xs opacity-90 block mt-0.5">Kota dan Permukiman yang Berkelanjutan</em>
                    </div>
                </div>
                <p class="text-xs leading-relaxed opacity-95 mt-4">
                    Mendorong keterlibatan masyarakat dalam pengumpulan dan pengelolaan sampah plastik untuk mendukung lingkungan yang lebih bersih dan berkelanjutan.
                </p>
            </div>

            <!-- SDG 12 -->
            <div class="rounded-3xl p-6 text-white flex flex-col justify-between shadow-lg min-h-[300px]" style="background:#BF8B2E">
                <div class="space-y-3">
                    <div class="w-16 h-16 border-2 border-white rounded-xl flex flex-col items-center justify-center leading-none">
                        <b class="text-2xl font-extrabold">12</b>
                        <span class="text-[9px] font-bold tracking-widest mt-0.5">SDG</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold uppercase tracking-wide leading-snug">Responsible Consumption and Production</h3>
                        <em class="not-italic text-xs opacity-90 block mt-0.5">Konsumsi dan Produksi yang Bertanggung Jawab</em>
                    </div>
                </div>
                <p class="text-xs leading-relaxed opacity-95 mt-4">
                    Mendukung pengurangan sampah plastik melalui pemanfaatan kembali sebagai bahan baku kerajinan tangan, sejalan dengan target 12.5 tentang pengurangan timbulan sampah melalui pencegahan, pengurangan, daur ulang, dan penggunaan kembali.
                </p>
            </div>

            <!-- SDG 8 -->
            <div class="rounded-3xl p-6 text-white flex flex-col justify-between shadow-lg min-h-[300px]" style="background:#A21942">
                <div class="space-y-3">
                    <div class="w-16 h-16 border-2 border-white rounded-xl flex flex-col items-center justify-center leading-none">
                        <b class="text-2xl font-extrabold">8</b>
                        <span class="text-[9px] font-bold tracking-widest mt-0.5">SDG</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold uppercase tracking-wide leading-snug">Decent Work and Economic Growth</h3>
                        <em class="not-italic text-xs opacity-90 block mt-0.5">Pekerjaan Layak dan Pertumbuhan Ekonomi</em>
                    </div>
                </div>
                <p class="text-xs leading-relaxed opacity-95 mt-4">
                    Mendukung pengembangan UMKM melalui pengolahan sampah plastik menjadi produk kerajinan bernilai tambah serta penyediaan informasi mengenai produk dan kegiatan usaha.
                </p>
            </div>

            <!-- SDG 9 -->
            <div class="rounded-3xl p-6 text-white flex flex-col justify-between shadow-lg min-h-[300px]" style="background:#FD6925">
                <div class="space-y-3">
                    <div class="w-16 h-16 border-2 border-white rounded-xl flex flex-col items-center justify-center leading-none">
                        <b class="text-2xl font-extrabold">9</b>
                        <span class="text-[9px] font-bold tracking-widest mt-0.5">SDG</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold uppercase tracking-wide leading-snug">Industry, Innovation and Infrastructure</h3>
                        <em class="not-italic text-xs opacity-90 block mt-0.5">Industri, Inovasi, dan Infrastruktur</em>
                    </div>
                </div>
                <p class="text-xs leading-relaxed opacity-95 mt-4">
                    Mendorong penerapan inovasi teknologi informasi melalui website yang mendukung digitalisasi pengelolaan informasi dan aliran material dalam rantai pasok balik sampah plastik.
                </p>
            </div>
        </div>
    </section>

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
