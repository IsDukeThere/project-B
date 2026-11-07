<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Project B Indonesia') - Daur Ulang & Kerajinan Sirkular</title>
    
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>♻️</text></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Vite atau CDN Fallback) -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('css/design-system.css') }}">
    @endif

    @stack('styles')
</head>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-emerald-200 selection:text-emerald-900">
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <!-- Navbar Reusable Component -->
    @include('components.navbar')

    <!-- Main Content Area -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-10">
        @yield('content')
    </main>

    <!-- Footer Reusable Component -->
    @include('components.footer')

    @stack('scripts')

    <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-3xl p-6 max-w-sm w-full mx-4 shadow-2xl transform scale-95 transition-transform duration-300" id="modalContainer">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-xl mb-4 border border-rose-100">
                ⚠️
            </div>
            <h3 class="text-lg font-extrabold text-slate-800">Yakin ingin keluar?</h3>
            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                Sesi akan diakhiri dan harus login ulang untuk masuk kembali.
            </p>
            <div class="flex items-center gap-3 mt-6">
                <button type="button" onclick="closeLogoutModal()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="button" onclick="executeLogout()" class="flex-1 py-2.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs shadow-md shadow-rose-500/20 transition">
                    Ya, Keluar
                </button>
            </div>
        </div>
    </div>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        window.openLogoutModal = function() {
            const modal = document.getElementById('logoutModal');
            const container = document.getElementById('modalContainer');
            if(modal && container) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                container.classList.remove('scale-95');
                container.classList.add('scale-100');
            }
        }

        window.closeLogoutModal = function() {
            const modal = document.getElementById('logoutModal');
            const container = document.getElementById('modalContainer');
            if(modal && container) {
                modal.classList.add('opacity-0', 'pointer-events-none');
                container.classList.remove('scale-100');
                container.classList.add('scale-95');
            }
        }

        window.executeLogout = function() {
            const form = document.getElementById('logoutForm');
            if(form) { form.submit(); }
        }
    </script>
</body>
</html>
