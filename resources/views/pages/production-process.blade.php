@extends('layouts.app')

@section('title', 'Alur Proses Produksi')

@push('styles')
<style>
    .pb-tl {
        position: relative;
        padding: 24px 0 12px;
        max-width: 960px;
        margin: 0 auto;
    }

    .pb-tl::before {
        content: "";
        position: absolute;
        left: 24px;
        top: 0;
        bottom: 0;
        width: 4px;
        border-radius: 4px;
        transform: translateX(-50%);
        background: #e2e8f0;
    }

    .pb-tl-fill {
        position: absolute;
        left: 24px;
        top: 0;
        width: 4px;
        height: calc(var(--p, 0) * 1%);
        border-radius: 4px;
        transform: translateX(-50%);
        background: linear-gradient(to bottom, #6ee7b7, #047857);
        box-shadow: 0 0 14px rgba(16, 185, 129, 0.6);
        transition: height 0.2s ease-out;
    }

    .pb-step {
        position: relative;
        display: flex;
        margin-bottom: 36px;
        padding-left: 68px;
    }

    .pb-step-node {
        position: absolute;
        left: 24px;
        top: 22px;
        width: 46px;
        height: 46px;
        transform: translateX(-50%);
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-weight: 800;
        font-size: 18px;
        color: #64748b;
        background: #ffffff;
        border: 3px solid #e2e8f0;
        z-index: 2;
        transition: all 0.4s ease;
    }

    .pb-step.on .pb-step-node {
        color: #ffffff;
        background: linear-gradient(135deg, #10b981, #047857);
        border-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.28), 0 8px 18px rgba(4, 120, 87, 0.35);
    }

    .pb-step-card {
        position: relative;
        width: 100%;
        display: grid;
        grid-template-columns: 290px 1fr;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(15, 42, 32, 0.06);
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease, box-shadow 0.3s ease;
    }

    .pb-step.show .pb-step-card {
        opacity: 1;
        transform: none;
    }

    .pb-step-card:hover {
        box-shadow: 0 18px 40px rgba(4, 120, 87, 0.18);
    }

    .pb-step-pic {
        position: relative;
        min-height: 200px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, var(--a), var(--b));
        overflow: hidden;
    }

    .pb-step-pic img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .pb-step-card:hover .pb-step-pic img {
        transform: scale(1.06);
    }

    /* Cadangan kalau ada tahap yang tidak pakai foto (pakai emoji) */
    .pb-step-pic .em {
        font-size: 72px;
        filter: drop-shadow(0 10px 12px rgba(0, 0, 0, 0.25));
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .pb-step-card:hover .pb-step-pic .em {
        transform: scale(1.15) rotate(-4deg);
    }

    .pb-step-pic .big {
        position: absolute;
        right: 10px;
        bottom: -22px;
        font-size: 120px;
        font-weight: 800;
        line-height: 1;
        color: #ffffff;
        opacity: 0.22;
        user-select: none;
    }

    .pb-step-badge {
        position: absolute;
        right: 12px;
        top: 12px;
        font-size: 11.5px;
        font-weight: 800;
        color: #047857;
        background: #ffffff;
        padding: 4px 12px;
        border-radius: 99px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        z-index: 2;
    }

    .pb-step-badge.gold {
        background: #fde047;
        color: #3a2a00;
    }

    .pb-step-body {
        padding: 22px 28px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .pb-step-no {
        font-size: 11.5px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #047857;
    }

    .pb-step-body h3 {
        margin: 2px 0 6px;
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
    }

    .pb-step-body p {
        margin: 0 0 14px;
        font-size: 13.5px;
        color: #64748b;
        line-height: 1.6;
    }

    .pb-step-stasiun {
        display: flex;
        align-items: center;
        gap: 8px;
        padding-top: 12px;
        border-top: 1px dashed #e2e8f0;
        font-size: 12.5px;
        color: #64748b;
    }

    .pb-step-stasiun b {
        color: #0f172a;
        font-weight: 700;
        background: #e6f4ee;
        padding: 3px 12px;
        border-radius: 99px;
    }

    .pb-tl-end {
        text-align: center;
        margin: 16px 0 64px;
    }

    .pb-tl-end span {
        display: inline-block;
        background: linear-gradient(135deg, #10b981, #047857);
        color: #ffffff;
        font-weight: 800;
        font-size: 13px;
        padding: 10px 24px;
        border-radius: 99px;
        box-shadow: 0 10px 24px rgba(4, 120, 87, 0.35);
    }

    @media (max-width: 760px) {
        .pb-step {
            padding-left: 56px;
        }
        .pb-step-card {
            grid-template-columns: 1fr;
        }
        .pb-step-pic {
            min-height: 0;
            height: 180px;
        }
        .pb-step-body {
            padding: 18px 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="space-y-8">
    <div class="pb-hero-banner">
        <div class="max-w-2xl space-y-3">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">Alur Proses Produksi</h1>
            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
                Lihat langsung bagaimana sampah plastik berubah jadi karya bernilai tinggi melalui 7 tahapan sirkular yang terukur.
            </p>
        </div>
    </div>

    <!-- Video Placeholder -->
    <div class="pb-card overflow-hidden bg-emerald-50 border-emerald-200 rounded-2xl shadow-sm max-w-4xl mx-auto">

            <div class="w-full bg-black">
                <video controls class="w-full aspect-video object-contain">
                    <source src="{{ asset('vid/Kompro.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video.
                </video>
            </div>
    </div>

    <!-- 5 Tahap Pengolahan (Responsive Grid) -->
    <div class="text-center space-y-2 pt-4">
        <div class="text-xs uppercase font-extrabold tracking-wider text-emerald-700">Dari Sampah Menjadi Karya</div>
        <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">7 Tahap Pengolahan Sirkular</h2>
        <p class="text-xs sm:text-sm text-slate-500 max-w-xl mx-auto">
            Setiap gram plastik diproses secara higienis melalui stasiun kerja terstandar hingga menjadi kerajinan siap guna.
        </p>
    </div>

    <!-- 7-Stage Vertical Timeline -->
    <div class="pb-tl" id="tl">
        <div class="pb-tl-fill" id="fill"></div>
        <div id="steps-container">
            @php
            $tahapan = [
                [
                    'judul' => 'Pengumpulan',
                    'badge' => '1 hari',
                    'stasiun' => 'Drop Point',
                    'em' => '📦',
                    'a' => '#fde68a',
                    'b' => '#fb923c',
                    'foto' => asset('images/alur-proses/pengumpulan.JPG'),
                    'desk' => 'Sampah plastik diterima dari warga, bank sampah, dan mitra drop-point terverifikasi.'
                ],
                [
                    'judul' => 'Pemilahan',
                    'badge' => '1 hari',
                    'stasiun' => 'Tim Sortir',
                    'em' => '🗂️',
                    'a' => '#a7f3d0',
                    'b' => '#34d399',
                    'foto' => asset('images/alur-proses/pemilahan.JPG'),
                    'desk' => 'Dipisah berdasarkan jenis: kemasan multilayer, PET, HDPE, dan PP serta dibersihkan.'
                ],
                [
                    'judul' => 'Pembersihan',
                    'badge' => '1 hari',
                    'stasiun' => 'Pembersihan',
                    'em' => '🧼',
                    'a' => '#bae6fd',
                    'b' => '#38bdf8',
                    'foto' => asset('images/alur-proses/pencucian.JPG'),
                    'desk' => 'Sampah plastik dibersihkan dari kotoran dan sisa material yang menempel.'
                ],
                [
                    'judul' => 'Pengeringan',
                    'badge' => '± 2-3 hari',
                    'stasiun' => 'Pengeringan',
                    'em' => '☀️',
                    'a' => '#fef08a',
                    'b' => '#f59e0b',
                    'foto' => asset('images/alur-proses/pengeringan.JPG'),
                    'desk' => 'Sampah plastik yang telah dibersihkan dijemur hingga kering sebelum masuk ke proses pencacahan.'
                ],
                [
                    'judul' => 'Pencacahan',
                    'badge' => '1 hari',
                    'stasiun' => 'Pencacahan',
                    'em' => '⚙️',
                    'a' => '#fecdd3',
                    'b' => '#fb7185',
                    'foto' => asset('images/alur-proses/pencacahan.PNG'),
                    'desk' => 'Sampah plastik dicacah menjadi potongan-potongan kecil.'
                ],
                [
                    'judul' => 'Pengolahan',
                    'badge' => '2-3 hari',
                    'stasiun' => 'Produksi',
                    'em' => '🏭',
                    'a' => '#ddd6fe',
                    'b' => '#a78bfa',
                    'foto' => asset('images/alur-proses/pengolahan.JPG'),
                    'desk' => 'Potongan plastik disusun sesuai pola, kemudian dijahit dan dirangkai menjadi berbagai produk kerajinan, seperti tas, dompet, dan aksesori.'
                ],
                [
                    'judul' => 'Produk Jadi',
                    'badge' => 'Siap Jual',
                    'stasiun' => 'QC Butik',
                    'em' => '🛍️',
                    'a' => '#99f6e4',
                    'b' => '#2dd4bf',
                    'foto' => asset('images/alur-proses/7. produk jady.png'),
                    'desk' => 'Dijahit oleh pengrajin lokal dengan quality control teliti, lalu dikemas.'
                ]
            ];
            @endphp

            @foreach($tahapan as $idx => $t)
            <div class="pb-step {{ $idx % 2 ? 'r' : 'l' }}">
                <div class="pb-step-node">{{ $idx + 1 }}</div>
                <article class="pb-step-card">
                    <div class="pb-step-pic" style="--a:{{ $t['a'] }};--b:{{ $t['b'] }}">
                        @if(!empty($t['foto']))
                            <img src="{{ $t['foto'] }}" alt="{{ $t['judul'] }}">
                        @else
                            <span class="em">{{ $t['em'] }}</span>
                            <span class="big">{{ $idx + 1 }}</span>
                        @endif
                        <span class="pb-step-badge {{ $t['badge'] === 'Siap Jual' ? 'gold' : '' }}">{{ $t['badge'] }}</span>
                    </div>
                    <div class="pb-step-body">
                        <div class="pb-step-no">Tahap {{ $idx + 1 }}</div>
                        <h3>{{ $t['judul'] }}</h3>
                        <p>{{ $t['desk'] }}</p>
                        <div class="pb-step-stasiun">
                            📍 Stasiun: <b>{{ $t['stasiun'] }}</b>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Timeline Footer Tag -->
    <div class="pb-tl-end">
        <span>♻ Siap digunakan kembali</span>
    </div>
</div>
@endsection

@push('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const steps = [...document.querySelectorAll(".pb-step")];
        const tl = document.getElementById("tl");
        const fill = document.getElementById("fill");

        function progress() {
            if (!tl || !fill) return;
            const r = tl.getBoundingClientRect();
            const mark = window.innerHeight * 0.6;
            const p = Math.max(0, Math.min(1, (mark - r.top) / r.height));
            fill.style.setProperty("--p", (p * 100).toFixed(1));

            steps.forEach(s => {
                const node = s.querySelector(".pb-step-node");
                if (node) {
                    s.classList.toggle("on", node.getBoundingClientRect().top < mark);
                }
            });
        }

        window.addEventListener("scroll", progress, { passive: true });
        window.addEventListener("resize", progress);
        progress();

        if ("IntersectionObserver" in window) {
            const io = new IntersectionObserver(es => {
                es.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add("show");
                        io.unobserve(e.target);
                    }
                });
            }, { threshold: 0.15 });

            steps.forEach(s => io.observe(s));
        } else {
            steps.forEach(s => s.classList.add("show"));
        }
    });
    </script>
@endpush