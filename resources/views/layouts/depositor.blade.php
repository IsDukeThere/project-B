<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Penyetor') - Project B Indonesia</title>
    
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>♻️</text></svg>">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('css/design-system.css') }}">
    @endif

    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- Topbar Penyetor -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('depositor.procedure') }}" class="flex items-center gap-2">
                    <span class="text-2xl">♻️</span>
                    <div>
                        <span class="font-extrabold text-slate-900 block leading-tight">Project B</span>
                        <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block">Penyetor</span>
                    </div>
                </a>
            </div>

            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold">

                <a href="{{ route('depositor.procedure') }}" 
                class="transition flex items-center gap-1.5 {{ request()->routeIs('depositor.procedure') ? 'text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700' }}">
                    @if(request()->routeIs('depositor.procedure')) <span>✨</span> @endif
                    Panduan Setor
                </a>

                <a href="{{ route('depositor.form') }}" 
                class="transition flex items-center gap-1.5 {{ request()->routeIs('depositor.form') ? 'text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700' }}">
                    @if(request()->routeIs('depositor.form')) <span>✨</span> @endif
                    Setor Sampah
                </a>

                <a href="{{ route('depositor.history') }}" 
                class="transition flex items-center gap-1.5 {{ request()->routeIs('depositor.history*') || request()->routeIs('depositor.detail*') ? 'text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700' }}">
                    @if(request()->routeIs('depositor.history*') || request()->routeIs('depositor.detail*')) <span>✨</span> @endif
                    Riwayat
                </a>

                <a href="{{ route('depositor.leaderboard') }}" 
                class="transition flex items-center gap-1.5 {{ request()->routeIs('depositor.leaderboard') ? 'text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700' }}">
                    @if(request()->routeIs('depositor.leaderboard')) <span>✨</span> @endif
                    Peringkat
                </a>

                <a href="{{ route('depositor.katalog') }}" 
                class="transition flex items-center gap-1.5 {{ request()->routeIs('depositor.katalog') ? 'text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700' }}">
                    @if(request()->routeIs('depositor.katalog')) <span>✨</span> @endif
                    Katalog
                </a>

            </nav>

            <div class="flex items-center gap-3">

                <a href="{{ route('depositor.profile') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-800 hover:bg-emerald-100 border border-emerald-200 text-xs font-semibold whitespace-nowrap">
                    <span class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-[10px] shrink-0">
                        {{ auth()->user()->initials }}
                    </span>

                    <span>Hello!, {{ auth()->user()->name }}</span>
                </a>

                    <button type="button" onclick="document.getElementById('logoutModal').classList.remove('opacity-0', 'pointer-events-none'); document.getElementById('modalContainer').classList.remove('scale-95'); document.getElementById('modalContainer').classList.add('scale-100');" class="text-xs text-rose-600 hover:underline font-semibold px-2 py-1">
                        Keluar
                    </button>

                    <div id="logoutModal" class="fixed inset-0 z-[99999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300 px-4"
                        onclick="if(event.target === this) { closeLogoutModal(); }">

                        <div class="bg-white rounded-[2rem] p-6 sm:p-8 max-w-sm w-full shadow-2xl transform scale-95 transition-transform duration-300 relative border border-slate-100" id="modalContainer">

                            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-xl mb-4 border border-rose-100 shadow-inner">
                                ⚠️
                            </div>

                            <h3 class="text-xl font-extrabold text-slate-900">Yakin ingin keluar?</h3>
                            <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                                Sesi akan diakhiri dan harus login ulang untuk masuk kembali.
                            </p>

                            <div class="flex items-center gap-3 mt-7">
                                <!-- Tombol Batal -->
                                <button type="button" onclick="closeLogoutModal()" class="flex-1 py-3 rounded-2xl border border-slate-200 text-slate-700 font-bold text-xs hover:bg-slate-50 transition active:scale-95">
                                    Batal
                                </button>

                                <!-- Tombol Ya, Keluar -->
                                <button type="button" onclick="document.getElementById('realLogoutForm').submit();" class="flex-1 py-3 rounded-2xl bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs shadow-lg shadow-rose-500/30 transition active:scale-95">
                                    Ya, Keluar
                                </button>
                            </div>

                        </div>
                    </div>

                    <form id="realLogoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>
</html>
