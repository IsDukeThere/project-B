<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Project B Indonesia</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛡️</text></svg>">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('css/design-system.css') }}">
    @endif

    @stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen">

    <div class="flex min-h-screen">

        <!-- Sidebar Navigation for Desktop -->
        @include('components.admin-sidebar')

        <!-- Main Body -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Topbar Header -->
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="document.getElementById('adminSidebar').classList.remove('-translate-x-full')" class="md:hidden p-2 -ml-2 text-slate-600 hover:bg-slate-100 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <span class="text-sm font-semibold text-slate-500">Panel Kendali Admin</span>
                </div>
                <div class="flex items-center gap-4">
                    @if($pendingDepositsCount > 0)
                        <div class="px-3 py-1 bg-amber-100 border border-amber-300 text-amber-900 text-xs font-extrabold rounded-full shadow-sm">
                            {{ $pendingDepositsCount }} Setoran Perlu Ditimbang
                        </div>
                    @else
                        <div class="px-3 py-1 bg-slate-100 text-slate-500 text-xs font-semibold rounded-full">
                            Tidak Ada Setoran Baru
                        </div>
                    @endif
                </div>
            </header>

            <main class="flex-1 p-6 sm:p-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>
        </div>

    </div>

    @stack('scripts')
</body>
</html>
