@extends('layouts.app')

@section('title', 'Detail Workshop')

@section('content')
<div class="space-y-6">
    <a href="{{ route('workshops.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
        ← Kembali ke Daftar Workshop
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Kolom Kiri: Ringkasan & Biaya -->
        <div class="lg:col-span-5 space-y-6">
            <div class="pb-img-placeholder h-56 w-full rounded-3xl bg-emerald-100 text-6xl">
                🎓
            </div>

            <div class="pb-card p-5 space-y-3">
                <h2 class="font-bold text-base text-slate-900">Informasi Pelaksanaan</h2>
                <div class="divide-y divide-slate-100 text-xs">
                    <div class="flex justify-between py-2">
                        <span class="text-slate-500">Tanggal Pelaksanaan</span>
                        <span class="font-bold text-slate-900">12 Okt 2026</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-slate-500">Waktu</span>
                        <span class="font-bold text-slate-900">09.00 - 12.00 WIB</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-slate-500">Kuota Peserta</span>
                        <span class="font-bold text-slate-900">30 Orang (Sisa 8 kursi)</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-slate-500">Biaya Investasi</span>
                        <span class="font-extrabold text-emerald-700">Gratis</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-slate-500">Instruktur</span>
                        <span class="font-bold text-slate-900">Tim Praktisi Lingkungan Project B</span>
                    </div>
                </div>

                <div class="pt-3">
                    <a href="https://lynk.id/projectbindonesia" target="_blank" class="pb-btn-primary w-full py-3 text-center block">
                        Daftar Sekarang (Lynk.id) →
                    </a>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: 15 Silabus Materi Lengkap (Sesuai Wireframe Hal 37) -->
        <div class="lg:col-span-7 space-y-6">
            <div>
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Materi Webinar & Training Online - Seri 1</span>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-1 leading-snug">
                    Transformasi Pengelolaan Sampah: Solusi dan Teknologi Ramah Lingkungan
                </h1>
                <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                    Dapatkan 15 materi webinar dan training online yang membahas berbagai wawasan, solusi, inovasi, serta teknologi dalam pengelolaan sampah dan lingkungan.
                </p>
            </div>

            <div class="space-y-3">
                <h3 class="font-extrabold text-base text-slate-900 flex items-center gap-2">
                    <span>📖</span> 15 Materi yang Didapat:
                </h3>
                <div class="bg-white p-6 rounded-3xl border border-slate-200 divide-y divide-slate-100 text-xs text-slate-700">
                    <div class="py-2.5">1. Membangun Budaya Pengelolaan Sampah Mandiri</div>
                    <div class="py-2.5">2. Bank Sampah Masa Depan Menuju Indonesia Emas 2045</div>
                    <div class="py-2.5">3. Edukasi Bijak Sampah Sejak dari Rumah (EBSIDI)</div>
                    <div class="py-2.5">4. Menuju Ramadhan Minim Sampah</div>
                    <div class="py-2.5">5. Index Sustainability dalam Pengelolaan Sampah</div>
                    <div class="py-2.5">6. Aplikasi Zero Waste Index dalam Sistem Pengelolaan Sampah</div>
                    <div class="py-2.5">7. Transformasi Pengelolaan Sampah: Solusi Pembakaran Ramah Lingkungan</div>
                    <div class="py-2.5">8. Ragam Teknologi Tepat Guna (TTG) dalam Pengelolaan Sampah di Indonesia</div>
                    <div class="py-2.5">9. Teori dan Aplikasi BSF dalam Biokonversi Sampah</div>
                    <div class="py-2.5">10. Teori dan Aplikasi Pemanfaatan Cacing (Vermikomposting)</div>
                    <div class="py-2.5">11. Sistem Informasi Geografis (SIG) dalam Optimalisasi Rute Sampah</div>
                    <div class="py-2.5">12. Rekayasa Lingkungan yang Inklusif: Menuju NDC dan SDGs 2030</div>
                    <div class="py-2.5">13. Solusi Berbasis Data untuk Kualitas Udara</div>
                    <div class="py-2.5">14. KLHS Rencana Pembangunan Daerah (RPJMD dan RPJPD)</div>
                    <div class="py-2.5">15. KLHS Rencana Tata Ruang (RTRW dan RDTR)</div>
                </div>
            </div>

            <div class="pb-card p-5 bg-emerald-50/50 border-emerald-100">
                <h4 class="font-bold text-xs text-emerald-950 mb-1">🎯 Sasaran Peserta:</h4>
                <p class="text-xs text-emerald-900 leading-relaxed">
                    Mahasiswa, akademisi, praktisi lingkungan, pengelola bank sampah, komunitas, instansi, maupun masyarakat umum.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
