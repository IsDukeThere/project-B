<footer class="bg-slate-900 text-slate-400 text-xs border-t border-slate-800 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <div class="space-y-3">
                <div class="flex items-center gap-2 text-white font-bold text-base">
                    <span class="text-xl">♻️</span>
                    <span>Project B Indonesia</span>
                </div>
                <p class="text-slate-400 text-xs leading-relaxed">
                    Platform ekonomi sirkular berbasis komunitas yang mengolah limbah kemasan sachet multilayer dan minyak jelantah menjadi produk kerajinan bernilai tinggi.
                </p>
            </div>

            <div class="space-y-2.5">
                <h4 class="text-white font-bold text-sm">Program & Edukasi</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('production-process') }}" class="hover:text-white transition">Alur Proses 5 Tahap</a></li>
                    <li><a href="{{ route('workshops.index') }}" class="hover:text-white transition">Webinar & Pelatihan</a></li>
                    <li><a href="{{ route('depositor.procedure') }}" class="hover:text-white transition">Panduan Setor Sampah</a></li>
                    <li><a href="{{ route('certificates.index') }}" class="hover:text-white transition">Pencapaian & Sertifikasi</a></li>
                </ul>
            </div>

            <div class="space-y-2.5">
                <h4 class="text-white font-bold text-sm">Katalog Produk</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('products.index') }}" class="hover:text-white transition">Tas Totebag Anyaman</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-white transition">Tempat Pensil & Dompet</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-white transition">Baju & Dekorasi Rumah</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-white transition">Cacahan Plastik Bersih</a></li>
                </ul>
            </div>

            <div class="space-y-2.5">
                <h4 class="text-white font-bold text-sm">Workshop & Butik</h4>
                <p class="text-slate-400">Jl. Sukoharjo No.132 A, Gejayan, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283</p>
                <p class="text-slate-400 font-semibold text-emerald-400">Senin–Sabtu: 08.00–20.00 WIB</p>
                <a href="https://maps.app.goo.gl/uL7YM4hXxWefP2Eq6" class="text-xs font-bold text-white hover:text-emerald-400 flex items-center gap-1 pt-1">
                    Petunjuk Arah Maps →
                </a>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-800 text-center text-slate-500 text-xs flex flex-col sm:flex-row justify-between items-center gap-2">
            <p>© 2026 Project B Indonesia. Hak Cipta Dilindungi.</p>
            <p class="text-slate-400">Inisiatif Pengelolaan Sampah & Pemberdayaan Pengrajin Lokal.</p>
        </div>
    </div>
</footer>
