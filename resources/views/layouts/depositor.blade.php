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
                class="transition flex items-center gap-1.5 {{ request()->routeIs('products.*') ? 'text-emerald-700 font-bold' : 'text-slate-600 hover:text-emerald-700' }}">
                    @if(request()->routeIs('products.*')) <span>✨</span> @endif
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

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs text-rose-600 hover:underline font-semibold px-2 py-1">
                        Keluar
                    </button>
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
