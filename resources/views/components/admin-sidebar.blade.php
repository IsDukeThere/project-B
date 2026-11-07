<aside class="w-64 bg-slate-900 text-white flex flex-col justify-between p-6 flex-shrink-0 min-h-screen">
    <div class="space-y-8">
        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <span class="text-2xl">♻️</span>
            <div>
                <span class="font-extrabold text-lg text-white block leading-tight">Project B</span>
                <span class="text-[10px] font-bold text-amber-400 uppercase tracking-wider block">Admin Panel</span>
            </div>
        </a>

        <!-- Navigation Menu -->
        <nav class="space-y-1.5 text-xs font-semibold">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <span>📊</span> Dashboard
            </a>
            <a href="{{ route('admin.deposits.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.deposits') ? 'bg-amber-500 text-slate-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <span>⚖️</span> Data Setoran Masuk
            </a>
            <a href="{{ route('admin.workshops.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('workshops.*') ? 'bg-amber-500 text-slate-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <span>🎓</span> Kelola Workshop
            </a>
            <a href="{{ route('admin.certificates.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.certificates') ? 'bg-amber-500 text-slate-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <span>📜</span> Kelola Sertifikat
            </a>
            <a href="{{ route('admin.points.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.points-config') ? 'bg-amber-500 text-slate-950 font-bold shadow-lg' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                <span>⚙️</span> Pengaturan Poin
            </a>
        </nav>
    </div>

    <!-- Admin Profile Info -->
    <div class="pt-6 border-t border-slate-800">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-9 h-9 rounded-full bg-amber-400 text-slate-900 font-bold text-xs flex items-center justify-center">
                AD
            </div>
            <div>
                <p class="font-bold text-xs text-white">Administrator</p>
                <p class="text-[10px] text-slate-400">admin@projectb.id</p>
            </div>
        </div>
        <button type="button" onclick="document.getElementById('logoutModal').classList.remove('opacity-0', 'pointer-events-none'); document.getElementById('modalContainer').classList.remove('scale-95'); document.getElementById('modalContainer').classList.add('scale-100');" class="block text-center text-xs py-2 px-3 rounded-xl border hover:border-rose-700 hover:text-rose-600 text-white border-slate-500 transition">
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
                    <button type="button" onclick="closeLogoutModal()" class="flex-1 py-3 rounded-2xl border border-slate-200 text-slate-700 font-bold text-xs hover:bg-slate-50 transition active:scale-95">
                        Batal
                    </button>

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
</aside>
