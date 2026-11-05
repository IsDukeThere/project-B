<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
        
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <span class="text-2xl">♻️</span>
            <div>
                <span class="font-extrabold text-lg text-slate-900 tracking-tight block leading-tight">Project B</span>
                <span class="text-[10px] font-semibold text-emerald-700 tracking-wider uppercase block">Indonesia</span>
            </div>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-600">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition {{ request()->routeIs('home') ? 'text-emerald-700 font-bold' : '' }}">Beranda</a>
            <a href="{{ route('production-process') }}" class="hover:text-emerald-700 transition {{ request()->routeIs('production-process') ? 'text-emerald-700 font-bold' : '' }}">Alur Proses</a>
            <a href="{{ route('products.index') }}" class="hover:text-emerald-700 transition {{ request()->routeIs('products.*') ? 'text-emerald-700 font-bold' : '' }}">Produk</a>
            <a href="{{ route('workshops.index') }}" class="hover:text-emerald-700 transition {{ request()->routeIs('workshops.*') ? 'text-emerald-700 font-bold' : '' }}">Workshop</a>
            <a href="{{ route('certificates.index') }}" class="hover:text-emerald-700 transition {{ request()->routeIs('certificates.*') ? 'text-emerald-700 font-bold' : '' }}">Tentang Kami</a>
            <a href="{{ route('location') }}" class="hover:text-emerald-700 transition {{ request()->routeIs('location') ? 'text-emerald-700 font-bold' : '' }}">Lokasi</a>
            <a href="{{ route('contact') }}" class="hover:text-emerald-700 transition {{ request()->routeIs('contact') ? 'text-emerald-700 font-bold' : '' }}">Kontak</a>
        </nav>

        <!-- Right Quick Actions -->
        <div class="flex items-center gap-3">
            {{-- <a href="{{ route('depositor.procedure') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-semibold hover:bg-emerald-100 transition">
                <span>👤</span> Mode Penyetor
            </a>
            <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 text-amber-900 border border-amber-200 text-xs font-semibold hover:bg-amber-100 transition">
                <span>🛡️</span> Admin
            </a> --}}

            <div class="hidden sm:flex items-center gap-2">
                <a href="{{ route('login') }}" class="text-xs font-bold text-slate-700 hover:text-emerald-700 px-3 py-2">Masuk</a>
                <a href="{{ route('register') }}" class="text-xs font-bold bg-emerald-700 hover:bg-emerald-800 text-white px-4 py-2 rounded-full transition shadow-sm">Daftar</a>
            </div>

            <!-- Hamburger Button for Mobile -->
            <button onclick="document.getElementById('mobile-drawer-blade').classList.toggle('hidden')" class="lg:hidden p-2 text-slate-700 hover:text-emerald-700 rounded-lg" aria-label="Menu Mobile">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

    </div>

    <!-- Mobile Drawer for Blade -->
    <div id="mobile-drawer-blade" class="hidden lg:hidden bg-white border-b border-slate-200 px-6 py-4 space-y-3">
        <a href="{{ route('home') }}" class="block text-sm font-semibold text-slate-700 hover:text-emerald-700">Beranda</a>
        <a href="{{ route('production-process') }}" class="block text-sm font-semibold text-slate-700 hover:text-emerald-700">Alur Proses</a>
        <a href="{{ route('products.index') }}" class="block text-sm font-semibold text-slate-700 hover:text-emerald-700">Produk</a>
        <a href="{{ route('workshops.index') }}" class="block text-sm font-semibold text-slate-700 hover:text-emerald-700">Workshop</a>
        <a href="{{ route('certificates.index') }}" class="block text-sm font-semibold text-slate-700 hover:text-emerald-700">Tentang Kami</a>
        <a href="{{ route('location') }}" class="block text-sm font-semibold text-slate-700 hover:text-emerald-700">Lokasi</a>
        <a href="{{ route('contact') }}" class="block text-sm font-semibold text-slate-700 hover:text-emerald-700">Kontak</a>
        <hr class="border-slate-100 my-2">
        <div class="flex gap-2">
            <a href="{{ route('login') }}" class="text-xs font-bold text-slate-700 hover:text-emerald-700 px-3 py-2">Masuk</a>
            <a href="{{ route('register') }}" class="text-xs font-bold bg-emerald-700 hover:bg-emerald-800 text-white px-4 py-2 rounded-full transition shadow-sm">Daftar</a>
        </div>
    </div>
</header>
