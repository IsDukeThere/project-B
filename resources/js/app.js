/**
 * Project B Indonesia - Truly Fluid Responsive Frontend Controller & Router
 * Scalable across Smartphone, Tablet, Laptop, and Desktop Viewports
 * Zero Phone Frames, Zero Obstructing Floating Bars, 100% Native Layout
 */

class ProjectBApp {
  constructor() {
    this.currentRole = 'public'; // 'public' | 'depositor' | 'admin'
    this.currentPage = 'beranda';
    this.selectedProduct = PB_DATA.products[0];
    this.selectedWorkshop = PB_DATA.workshops[0];
    this.selectedDeposit = PB_DATA.deposits[0];
    this.selectedWasteDetail = PB_DATA.wasteTypes[0];
    this.selectedCertificate = PB_DATA.certificates[0];
    this.mobileMenuOpen = false;
    this.activeDepositFilter = 'Menunggu';
    this.cancelReason = 'Salah isi data';

    this.init();
  }

  init() {
    this.setupEventListeners();
    this.render();
  }

  setRole(role, defaultPage = null) {
    this.currentRole = role;
    if (defaultPage) {
      this.currentPage = defaultPage;
    } else {
      if (role === 'admin') this.currentPage = 'admin-beranda';
      else if (role === 'depositor') this.currentPage = 'prosedur-penyetoran';
      else this.currentPage = 'beranda';
    }
    this.mobileMenuOpen = false;
    window.scrollTo({ top: 0, behavior: 'smooth' });
    this.render();
    this.showToast(`Beralih ke peran: ${role === 'admin' ? 'Administrator' : role === 'depositor' ? 'Penyetor (Rina)' : 'Publik / Tamu'}`);
  }

  navigateTo(page, param = null) {
    this.currentPage = page;
    if (param) {
      if (page === 'detail-produk') this.selectedProduct = param;
      if (page === 'detail-workshop') this.selectedWorkshop = param;
      if (page === 'detail-setoran') this.selectedDeposit = param;
      if (page === 'detail-sampah') this.selectedWasteDetail = param;
      if (page === 'detail-sertifikat') this.selectedCertificate = param;
    }
    this.mobileMenuOpen = false;
    window.scrollTo({ top: 0, behavior: 'smooth' });
    this.render();
  }

  showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl text-sm font-semibold shadow-2xl flex items-center gap-3 transition-all transform duration-300 animate-fade-in ${
      type === 'success' ? 'bg-emerald-900 text-white border border-emerald-700' : 'bg-slate-900 text-white'
    }`;
    toast.innerHTML = `<span>${type === 'success' ? '✅' : 'ℹ️'}</span> <span>${message}</span>`;
    document.body.appendChild(toast);
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(10px)';
      setTimeout(() => toast.remove(), 300);
    }, 3200);
  }

  setupEventListeners() {
    window.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.mobileMenuOpen) {
        this.toggleMenu(false);
      }
    });
  }

  toggleMenu(open = null) {
    this.mobileMenuOpen = open !== null ? open : !this.mobileMenuOpen;
    const drawer = document.getElementById('mobile-drawer');
    const overlay = document.getElementById('drawer-overlay');
    if (drawer && overlay) {
      if (this.mobileMenuOpen) {
        drawer.classList.remove('translate-x-full');
        drawer.classList.add('translate-x-0');
        overlay.classList.remove('hidden');
      } else {
        drawer.classList.add('translate-x-full');
        drawer.classList.remove('translate-x-0');
        overlay.classList.add('hidden');
      }
    }
  }

  /* ==========================================================================
     GLOBAL HEADER & DESKTOP NAVIGATION
     ========================================================================== */
  renderHeader() {
    const isDepositor = this.currentRole === 'depositor';
    const isAdmin = this.currentRole === 'admin';

    return `
      <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200">
        <div class="pb-container py-3.5 flex items-center justify-between">
          
          <!-- Brand Logo -->
          <div class="flex items-center gap-3 cursor-pointer" onclick="app.navigateTo(app.currentRole === 'admin' ? 'admin-beranda' : 'beranda')">
            <span class="text-2xl">♻️</span>
            <div>
              <span class="font-extrabold text-lg text-slate-900 tracking-tight block leading-tight">Project B</span>
              <span class="text-[10px] font-semibold text-emerald-700 tracking-wider uppercase block">Indonesia</span>
            </div>
          </div>

          <!-- Desktop Navigation Links (Hidden on Mobile/Tablet, Visible on Laptop/Desktop) -->
          <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-600">
            ${isAdmin ? `
              <button onclick="app.navigateTo('admin-beranda')" class="hover:text-emerald-700 transition ${this.currentPage === 'admin-beranda' ? 'text-emerald-700 font-bold' : ''}">Dashboard Admin</button>
              <button onclick="app.navigateTo('admin-setoran')" class="hover:text-emerald-700 transition ${this.currentPage === 'admin-setoran' ? 'text-emerald-700 font-bold' : ''}">Verifikasi Setoran</button>
              <button onclick="app.navigateTo('admin-workshop')" class="hover:text-emerald-700 transition ${this.currentPage === 'admin-workshop' ? 'text-emerald-700 font-bold' : ''}">Kelola Workshop</button>
              <button onclick="app.navigateTo('admin-sertifikat')" class="hover:text-emerald-700 transition ${this.currentPage === 'admin-sertifikat' ? 'text-emerald-700 font-bold' : ''}">Kelola Sertifikat</button>
              <button onclick="app.navigateTo('admin-poin')" class="hover:text-emerald-700 transition ${this.currentPage === 'admin-poin' ? 'text-emerald-700 font-bold' : ''}">Pengaturan Poin</button>
            ` : isDepositor ? `
              <button onclick="app.navigateTo('prosedur-penyetoran')" class="hover:text-emerald-700 transition ${this.currentPage === 'prosedur-penyetoran' ? 'text-emerald-700 font-bold' : ''}">Panduan Setor</button>
              <button onclick="app.navigateTo('form-setor')" class="text-emerald-600 hover:text-emerald-700 font-bold transition flex items-center gap-1">✨ Setor Sampah</button>
              <button onclick="app.navigateTo('riwayat')" class="hover:text-emerald-700 transition ${this.currentPage === 'riwayat' ? 'text-emerald-700 font-bold' : ''}">Riwayat</button>
              <button onclick="app.navigateTo('peringkat')" class="hover:text-emerald-700 transition ${this.currentPage === 'peringkat' ? 'text-emerald-700 font-bold' : ''}">Peringkat</button>
              <button onclick="app.navigateTo('produk')" class="hover:text-emerald-700 transition ${this.currentPage === 'produk' ? 'text-emerald-700 font-bold' : ''}">Katalog Produk</button>
              <button onclick="app.navigateTo('workshop')" class="hover:text-emerald-700 transition ${this.currentPage === 'workshop' ? 'text-emerald-700 font-bold' : ''}">Workshop</button>
            ` : `
              <button onclick="app.navigateTo('beranda')" class="hover:text-emerald-700 transition ${this.currentPage === 'beranda' ? 'text-emerald-700 font-bold' : ''}">Beranda</button>
              <button onclick="app.navigateTo('alur-proses')" class="hover:text-emerald-700 transition ${this.currentPage === 'alur-proses' ? 'text-emerald-700 font-bold' : ''}">Alur Proses</button>
              <button onclick="app.navigateTo('produk')" class="hover:text-emerald-700 transition ${this.currentPage === 'produk' ? 'text-emerald-700 font-bold' : ''}">Produk</button>
              <button onclick="app.navigateTo('workshop')" class="hover:text-emerald-700 transition ${this.currentPage === 'workshop' ? 'text-emerald-700 font-bold' : ''}">Workshop</button>
              <button onclick="app.navigateTo('penghargaan')" class="hover:text-emerald-700 transition ${this.currentPage === 'penghargaan' ? 'text-emerald-700 font-bold' : ''}">Pencapaian</button>
              <button onclick="app.navigateTo('lokasi')" class="hover:text-emerald-700 transition ${this.currentPage === 'lokasi' ? 'text-emerald-700 font-bold' : ''}">Lokasi</button>
              <button onclick="app.navigateTo('kontak')" class="hover:text-emerald-700 transition ${this.currentPage === 'kontak' ? 'text-emerald-700 font-bold' : ''}">Kontak</button>
            `}
          </nav>

          <!-- Right Actions & Natural Role Selector -->
          <div class="flex items-center gap-3">
            <!-- Role Switcher Pill -->
            <div class="flex items-center bg-slate-100 p-1 rounded-full text-xs font-semibold border border-slate-200">
              <button onclick="app.setRole('public')" class="px-2.5 py-1 rounded-full transition ${this.currentRole === 'public' ? 'bg-white shadow-sm text-slate-800 font-bold' : 'text-slate-500 hover:text-slate-800'}">
                Publik
              </button>
              <button onclick="app.setRole('depositor')" class="px-2.5 py-1 rounded-full transition ${this.currentRole === 'depositor' ? 'bg-emerald-600 shadow-sm text-white font-bold' : 'text-slate-500 hover:text-slate-800'}">
                Penyetor
              </button>
              <button onclick="app.setRole('admin')" class="px-2.5 py-1 rounded-full transition ${this.currentRole === 'admin' ? 'bg-amber-600 shadow-sm text-white font-bold' : 'text-slate-500 hover:text-slate-800'}">
                Admin
              </button>
            </div>

            <!-- User Auth Chips on Desktop -->
            <div class="hidden sm:flex items-center gap-2">
              ${isDepositor ? `
                <button onclick="app.navigateTo('profil')" class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-800 hover:bg-emerald-100 border border-emerald-200 text-xs font-semibold transition">
                  <span class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-[10px]">${PB_DATA.user.avatar}</span>
                  <span>${PB_DATA.user.name.split(' ')[0]}</span>
                </button>
              ` : isAdmin ? `
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 text-amber-900 border border-amber-200 text-xs font-bold">
                  <span>🛡️</span> Admin
                </div>
              ` : `
                <button onclick="app.navigateTo('login')" class="text-xs font-bold text-slate-700 hover:text-emerald-700 px-3 py-2">
                  Masuk
                </button>
                <button onclick="app.navigateTo('register')" class="text-xs font-bold bg-emerald-700 hover:bg-emerald-800 text-white px-4 py-2 rounded-full transition shadow-sm">
                  Daftar
                </button>
              `}
            </div>

            <!-- Hamburger Button for Mobile / Tablet -->
            <button onclick="app.toggleMenu(true)" class="lg:hidden p-2 text-slate-700 hover:text-emerald-700 rounded-lg focus:outline-none" aria-label="Menu Mobile">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>

        </div>
      </header>
    `;
  }

  /* ==========================================================================
     MOBILE DRAWER (FOR SMARTPHONE & TABLET)
     ========================================================================== */
  renderDrawer() {
    const isDepositor = this.currentRole === 'depositor';
    const isAdmin = this.currentRole === 'admin';

    return `
      <!-- Backdrop Overlay -->
      <div id="drawer-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden transition-opacity" onclick="app.toggleMenu(false)"></div>
      
      <!-- Slide-over Drawer -->
      <div id="mobile-drawer" class="fixed top-0 right-0 h-full w-[310px] max-w-[85vw] bg-white z-50 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between p-6 overflow-y-auto">
        <div>
          <!-- Close button & Brand -->
          <div class="flex items-center justify-between pb-6 border-b border-slate-100 mb-6">
            <div class="flex items-center gap-2">
              <span class="text-2xl">♻️</span>
              <div>
                <span class="font-extrabold text-slate-900 block leading-tight">Project B</span>
                <span class="text-[10px] font-semibold text-emerald-700 uppercase tracking-wider block">Indonesia</span>
              </div>
            </div>
            <button onclick="app.toggleMenu(false)" class="p-1.5 text-slate-400 hover:text-slate-700">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
          </div>

          <!-- Nav Items -->
          <nav class="flex flex-col space-y-4 text-sm font-semibold text-slate-700">
            <button onclick="app.navigateTo('beranda')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'beranda' ? 'text-emerald-700 font-bold' : ''}">Beranda</button>
            <button onclick="app.navigateTo('alur-proses')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'alur-proses' ? 'text-emerald-700 font-bold' : ''}">Alur Proses</button>
            <button onclick="app.navigateTo('produk')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'produk' ? 'text-emerald-700 font-bold' : ''}">Katalog Produk</button>
            <button onclick="app.navigateTo('workshop')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'workshop' ? 'text-emerald-700 font-bold' : ''}">Workshop</button>
            <button onclick="app.navigateTo('penghargaan')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'penghargaan' ? 'text-emerald-700 font-bold' : ''}">Pencapaian Kami</button>

            ${isDepositor ? `
              <hr class="border-slate-100 my-2" />
              <div class="text-[11px] uppercase tracking-wider text-emerald-700 font-bold">Menu Penyetor</div>
              <button onclick="app.navigateTo('prosedur-penyetoran')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'prosedur-penyetoran' ? 'text-emerald-700 font-bold' : ''}">Prosedur Penyetoran</button>
              <button onclick="app.navigateTo('form-setor')" class="text-left py-1 text-emerald-600 font-bold">✨ Setor Sampah Baru</button>
              <button onclick="app.navigateTo('riwayat')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'riwayat' ? 'text-emerald-700 font-bold' : ''}">Riwayat Setoran</button>
              <button onclick="app.navigateTo('peringkat')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'peringkat' ? 'text-emerald-700 font-bold' : ''}">Peringkat Penyetor</button>
              <button onclick="app.navigateTo('profil')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'profil' ? 'text-emerald-700 font-bold' : ''}">Profil & Akun</button>
            ` : ''}

            ${isAdmin ? `
              <hr class="border-slate-100 my-2" />
              <div class="text-[11px] uppercase tracking-wider text-amber-700 font-bold">Menu Admin</div>
              <button onclick="app.navigateTo('admin-beranda')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'admin-beranda' ? 'text-emerald-700 font-bold' : ''}">Dashboard Admin</button>
              <button onclick="app.navigateTo('admin-setoran')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'admin-setoran' ? 'text-emerald-700 font-bold' : ''}">Data Setoran Masuk</button>
              <button onclick="app.navigateTo('admin-workshop')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'admin-workshop' ? 'text-emerald-700 font-bold' : ''}">Kelola Workshop</button>
              <button onclick="app.navigateTo('admin-sertifikat')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'admin-sertifikat' ? 'text-emerald-700 font-bold' : ''}">Kelola Sertifikat</button>
              <button onclick="app.navigateTo('admin-poin')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'admin-poin' ? 'text-emerald-700 font-bold' : ''}">Pengaturan Poin</button>
            ` : ''}

            <hr class="border-slate-100 my-2" />
            <button onclick="app.navigateTo('lokasi')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'lokasi' ? 'text-emerald-700 font-bold' : ''}">Lokasi</button>
            <button onclick="app.navigateTo('kontak')" class="text-left py-1 hover:text-emerald-700 ${this.currentPage === 'kontak' ? 'text-emerald-700 font-bold' : ''}">Kontak</button>
          </nav>
        </div>

        <!-- Auth Bottom Actions -->
        <div class="pt-6 border-t border-slate-100">
          ${isDepositor || isAdmin ? `
            <div class="flex items-center gap-3 mb-4">
              <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-xs">
                ${isAdmin ? 'AD' : PB_DATA.user.avatar}
              </div>
              <div class="text-xs">
                <p class="font-bold text-slate-800">${isAdmin ? 'Admin Project B' : PB_DATA.user.name}</p>
                <p class="text-slate-500">${isAdmin ? 'Administrator' : PB_DATA.user.phone}</p>
              </div>
            </div>
            <button onclick="app.setRole('public', 'beranda')" class="w-full py-2.5 px-4 rounded-xl text-center text-xs font-semibold border border-rose-200 text-rose-600 hover:bg-rose-50 flex items-center justify-center gap-2">
              <span>🚪</span> Keluar (Logout)
            </button>
          ` : `
            <button onclick="app.navigateTo('login')" class="w-full pb-btn-primary mb-2 text-center text-xs font-semibold">
              Masuk
            </button>
            <button onclick="app.navigateTo('register')" class="w-full pb-btn-outline text-center text-xs font-semibold">
              Daftar Penyetor
            </button>
          `}
        </div>
      </div>
    `;
  }

  /* ==========================================================================
     GLOBAL RESPONSIVE FOOTER
     ========================================================================== */
  renderFooter() {
    return `
      <footer class="bg-slate-900 text-slate-400 text-xs border-t border-slate-800 mt-20">
        <div class="pb-container py-12">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- Brand Info -->
            <div class="space-y-3">
              <div class="flex items-center gap-2 text-white font-bold text-base">
                <span class="text-xl">♻️</span>
                <span>Project B Indonesia</span>
              </div>
              <p class="text-slate-400 text-xs leading-relaxed">
                Platform ekonomi sirkular berbasis komunitas yang mengubah limbah kemasan sachet multilayer dan jelantah menjadi produk kerajinan bernilai tinggi.
              </p>
              <div class="flex gap-3 text-base text-slate-300 pt-1">
                <span class="cursor-pointer hover:text-white" onclick="app.navigateTo('kontak')">📸</span>
                <span class="cursor-pointer hover:text-white" onclick="app.navigateTo('kontak')">💬</span>
                <span class="cursor-pointer hover:text-white" onclick="app.navigateTo('kontak')">✉️</span>
              </div>
            </div>

            <!-- Program Publik -->
            <div class="space-y-2.5">
              <h4 class="text-white font-bold text-sm">Program & Edukasi</h4>
              <ul class="space-y-2">
                <li><button onclick="app.navigateTo('alur-proses')" class="hover:text-white transition">Alur Proses 5 Tahap</button></li>
                <li><button onclick="app.navigateTo('workshop')" class="hover:text-white transition">Webinar & Pelatihan</button></li>
                <li><button onclick="app.navigateTo('prosedur-penyetoran')" class="hover:text-white transition">Panduan Setor Sampah</button></li>
                <li><button onclick="app.navigateTo('penghargaan')" class="hover:text-white transition">Pencapaian & Sertifikasi</button></li>
              </ul>
            </div>

            <!-- Produk Kerajinan -->
            <div class="space-y-2.5">
              <h4 class="text-white font-bold text-sm">Katalog Produk</h4>
              <ul class="space-y-2">
                <li><button onclick="app.navigateTo('produk')" class="hover:text-white transition">Tas Totebag Anyaman</button></li>
                <li><button onclick="app.navigateTo('produk')" class="hover:text-white transition">Pouch & Tempat Pensil</button></li>
                <li><button onclick="app.navigateTo('produk')" class="hover:text-white transition">Baju & Dekorasi Ramah Lingkungan</button></li>
                <li><button onclick="app.navigateTo('produk')" class="hover:text-white transition">Cacahan Plastik Bersih</button></li>
              </ul>
            </div>

            <!-- Kontak & Workshop -->
            <div class="space-y-2.5">
              <h4 class="text-white font-bold text-sm">Workshop & Butik</h4>
              <p class="text-slate-400">${PB_DATA.location.address}</p>
              <p class="text-slate-400 font-semibold text-emerald-400">Senin–Sabtu: 08.00–16.00 WIB</p>
              <button onclick="app.navigateTo('lokasi')" class="text-xs font-bold text-white hover:text-emerald-400 flex items-center gap-1 pt-1">
                Petunjuk Arah Maps →
              </button>
            </div>
          </div>

          <div class="pt-8 border-t border-slate-800 text-center text-slate-500 text-xs flex flex-col sm:flex-row justify-between items-center gap-2">
            <p>© 2026 Project B Indonesia. Hak Cipta Dilindungi.</p>
            <p class="text-slate-400">Inisiatif Pengelolaan Sampah & Pemberdayaan Pengrajin Lokal.</p>
          </div>
        </div>
      </footer>
    `;
  }

  /* ==========================================================================
     CORE RENDER DISPATCHER
     ========================================================================== */
  render() {
    const root = document.getElementById('app-main');
    if (!root) return;

    let contentHtml = '';

    switch (this.currentPage) {
      // 1. PUBLIC PAGES
      case 'beranda':
        contentHtml = this.renderPageBeranda();
        break;
      case 'alur-proses':
        contentHtml = this.renderPageAlurProses();
        break;
      case 'produk':
        contentHtml = this.renderPageProduk();
        break;
      case 'detail-produk':
        contentHtml = this.renderPageDetailProduk();
        break;
      case 'workshop':
        contentHtml = this.renderPageWorkshop();
        break;
      case 'detail-workshop':
        contentHtml = this.renderPageDetailWorkshop();
        break;
      case 'penghargaan':
        contentHtml = this.renderPagePenghargaan();
        break;
      case 'detail-sertifikat':
        contentHtml = this.renderPageDetailSertifikat();
        break;
      case 'lokasi':
        contentHtml = this.renderPageLokasi();
        break;
      case 'kontak':
        contentHtml = this.renderPageKontak();
        break;
      case 'login':
        contentHtml = this.renderPageLogin();
        break;
      case 'register':
        contentHtml = this.renderPageRegister();
        break;

      // 2. DEPOSITOR PAGES
      case 'prosedur-penyetoran':
        contentHtml = this.renderPageProsedurPenyetoran();
        break;
      case 'detail-sampah':
        contentHtml = this.renderPageDetailSampah();
        break;
      case 'form-setor':
        contentHtml = this.renderPageFormSetor();
        break;
      case 'riwayat':
        contentHtml = this.renderPageRiwayat();
        break;
      case 'detail-setoran':
        contentHtml = this.renderPageDetailSetoran();
        break;
      case 'batal-setoran-modal':
        contentHtml = this.renderPageBatalSetoranModal();
        break;
      case 'setoran-dibatalkan':
        contentHtml = this.renderPageSetoranDibatalkan();
        break;
      case 'peringkat':
        contentHtml = this.renderPagePeringkat();
        break;
      case 'profil':
        contentHtml = this.renderPageProfil();
        break;
      case 'ubah-profil':
        contentHtml = this.renderPageUbahProfil();
        break;
      case 'ubah-sandi':
        contentHtml = this.renderPageUbahSandi();
        break;

      // 3. ADMIN PAGES
      case 'admin-beranda':
        contentHtml = this.renderPageAdminBeranda();
        break;
      case 'admin-setoran':
        contentHtml = this.renderPageAdminSetoran();
        break;
      case 'admin-workshop':
        contentHtml = this.renderPageAdminWorkshop();
        break;
      case 'admin-sertifikat':
        contentHtml = this.renderPageAdminSertifikat();
        break;
      case 'admin-poin':
        contentHtml = this.renderPageAdminPoin();
        break;

      default:
        contentHtml = this.renderPageBeranda();
    }

    root.innerHTML = `
      ${this.renderHeader()}
      <main class="flex-grow pb-container py-6 sm:py-8 lg:py-10">
        ${contentHtml}
      </main>
      ${this.renderFooter()}
      ${this.renderDrawer()}
    `;
  }

  /* ==========================================================================
     PAGE 1: BERANDA PUBLIK (FLUID RESPONSIVE)
     ========================================================================== */
  renderPageBeranda() {
    return `
      <div class="space-y-10 sm:space-y-12">
        
        <!-- Hero Section: Fluid 2-Columns on Desktop, Stacked on Mobile -->
        <div class="pb-hero-banner">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Column: Copy & Actions -->
            <div class="lg:col-span-7 space-y-4 sm:space-y-5">
              <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-800/60 border border-emerald-400/30 text-emerald-200 text-xs font-semibold">
                <span>🌱</span> Gerakan Daur Ulang Mandiri
              </div>
              <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-white tracking-tight">
                Sampah Bukan Akhir, Tapi Awal Sebuah Karya
              </h1>
              <p class="text-emerald-100 text-sm sm:text-base leading-relaxed max-w-xl">
                Setiap sampah yang terkumpul memiliki kesempatan untuk memiliki kehidupan kedua. Melalui proses kreatif di workshop kami, sampah plastik yang sebelumnya dianggap tidak bernilai diolah menjadi berbagai produk yang dapat digunakan kembali.
              </p>
              
              <div class="flex flex-wrap items-center gap-3 pt-2">
                <button onclick="app.setRole('depositor', 'prosedur-penyetoran')" class="bg-white text-emerald-950 font-bold px-6 py-3 rounded-full text-sm hover:bg-emerald-50 transition shadow-lg">
                  Mulai Setor Sampah →
                </button>
                <button onclick="app.navigateTo('alur-proses')" class="bg-emerald-900/40 border border-emerald-400/40 text-white font-semibold px-5 py-3 rounded-full text-sm hover:bg-emerald-800/60 transition">
                  Lihat Alur Proses
                </button>
              </div>
            </div>

            <!-- Right Column: Interactive Circular Metrics Card -->
            <div class="lg:col-span-5">
              <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 sm:p-7 text-white space-y-5 shadow-2xl">
                <div class="flex items-center justify-between border-b border-white/15 pb-4">
                  <div>
                    <p class="text-xs uppercase tracking-wider text-emerald-200 font-bold">Dampak Nyata</p>
                    <h3 class="text-lg font-bold text-white">Sirkularitas Project B</h3>
                  </div>
                  <span class="text-3xl">♻️</span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div class="bg-black/20 p-3.5 rounded-2xl">
                    <span class="text-2xl font-black text-white block">20+ Ton</span>
                    <span class="text-xs text-emerald-200">Sampah Terolah</span>
                  </div>
                  <div class="bg-black/20 p-3.5 rounded-2xl">
                    <span class="text-2xl font-black text-white block">150+</span>
                    <span class="text-xs text-emerald-200">Penyetor Aktif</span>
                  </div>
                  <div class="bg-black/20 p-3.5 rounded-2xl">
                    <span class="text-2xl font-black text-white block">40+</span>
                    <span class="text-xs text-emerald-200">Pengrajin Lokal</span>
                  </div>
                  <div class="bg-black/20 p-3.5 rounded-2xl">
                    <span class="text-2xl font-black text-white block">10 Poin</span>
                    <span class="text-xs text-emerald-200">Per kg Sampah</span>
                  </div>
                </div>

                <p class="text-xs text-emerald-100/80 leading-snug">
                  Mendukung SDGs 12: Konsumsi & Produksi Berkelanjutan di wilayah Yogyakarta dan sekitarnya.
                </p>
              </div>
            </div>

          </div>
        </div>

        <!-- Quick Access Banners (2 Columns on Tablet & Desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
          <div onclick="app.setRole('depositor', 'prosedur-penyetoran')" class="pb-card pb-card-interactive flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-3xl flex-shrink-0">
              🍜
            </div>
            <div>
              <h3 class="font-bold text-base text-slate-900">Panduan Penyetoran Sampah</h3>
              <p class="text-xs text-slate-500 mt-1">Kemasan multilayer sachet & minyak jelantah dapat ditukar poin hadiah.</p>
              <span class="text-xs font-bold text-emerald-700 mt-2 inline-block">Baca Prosedur Lengkap →</span>
            </div>
          </div>

          <div onclick="app.navigateTo('penghargaan')" class="pb-card pb-card-interactive flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center text-3xl flex-shrink-0">
              🏆
            </div>
            <div>
              <h3 class="font-bold text-base text-slate-900">Pencapaian & Kredibilitas</h3>
              <p class="text-xs text-slate-500 mt-1">Penghargaan UMKM Hijau Terbaik dari Dinas Lingkungan Hidup 2026.</p>
              <span class="text-xs font-bold text-amber-800 mt-2 inline-block">Lihat Sertifikasi & Testimoni →</span>
            </div>
          </div>
        </div>

        <!-- Section Produk Kami: 2 Cols Mobile, 3 Cols Tablet, 4 Cols Desktop -->
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900">Produk Kami</h2>
              <p class="text-xs sm:text-sm text-slate-500">Koleksi kerajinan tangan hasil daur ulang bernilai estetika dan fungsional</p>
            </div>
            <button onclick="app.navigateTo('produk')" class="text-xs sm:text-sm font-bold text-emerald-700 hover:text-emerald-800">
              Lihat Semua →
            </button>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            ${PB_DATA.products.slice(0, 4).map(prod => `
              <div onclick="app.navigateTo('detail-produk', PB_DATA.products.find(p => p.id === '${prod.id}'))" class="pb-card pb-card-interactive flex flex-col justify-between">
                <div>
                  <div class="pb-img-placeholder h-40 sm:h-48 w-full mb-3 rounded-2xl text-4xl sm:text-5xl">
                    ${prod.imageIcon}
                  </div>
                  <span class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full inline-block mb-1.5">
                    ${prod.category}
                  </span>
                  <h3 class="font-bold text-sm text-slate-900 line-clamp-1 mb-1">${prod.name}</h3>
                  <p class="text-xs text-slate-500 line-clamp-2 mb-3 leading-relaxed">${prod.description}</p>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                  <span class="font-extrabold text-sm sm:text-base text-slate-900">${prod.priceFormatted}</span>
                  <span class="text-xs font-bold text-emerald-700">Detail ›</span>
                </div>
              </div>
            `).join('')}
          </div>
        </div>

        <!-- Section Workshop: 1 Col Mobile, 2 Cols Tablet, 3 Cols Desktop -->
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900">Workshop & Pelatihan</h2>
              <p class="text-xs sm:text-sm text-slate-500">Tingkatkan keahlian dalam memilah dan mengolah sampah sirkular</p>
            </div>
            <button onclick="app.navigateTo('workshop')" class="text-xs sm:text-sm font-bold text-emerald-700 hover:text-emerald-800">
              Semua Jadwal →
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            ${PB_DATA.workshops.map(ws => `
              <div onclick="app.navigateTo('detail-workshop', PB_DATA.workshops.find(w => w.id === '${ws.id}'))" class="pb-card pb-card-interactive flex flex-col justify-between space-y-4">
                <div>
                  <div class="flex items-center justify-between mb-2">
                    <span class="text-xs px-3 py-1 rounded-full bg-emerald-50 font-bold text-emerald-800">${ws.date}</span>
                    <span class="badge-pending text-[10px]">Sisa ${ws.remainingSeats} kursi</span>
                  </div>
                  <h3 class="font-bold text-sm sm:text-base text-slate-900 line-clamp-2 leading-snug mb-1">
                    ${ws.title}
                  </h3>
                  <p class="text-xs text-slate-500">${ws.time} • Instruktur: ${ws.instructor}</p>
                </div>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                  <span class="font-extrabold text-sm text-emerald-700">${ws.price}</span>
                  <span class="text-xs font-bold text-slate-700">Silabus & Daftar →</span>
                </div>
              </div>
            `).join('')}
          </div>
        </div>

        <!-- Section Alamat UMKM: 2 Columns on Desktop -->
        <div class="pb-card p-6 sm:p-8">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-7 space-y-3">
              <span class="text-xs uppercase font-bold tracking-wider text-emerald-700">Lokasi & Drop Point</span>
              <h2 class="font-extrabold text-xl sm:text-2xl text-slate-900">${PB_DATA.location.name}</h2>
              <p class="text-sm text-slate-600">${PB_DATA.location.address}</p>
              
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 text-xs">
                ${PB_DATA.location.hours.map(h => `
                  <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <p class="text-slate-500 font-medium">${h.day}</p>
                    <p class="font-bold text-slate-900 mt-0.5">${h.time}</p>
                  </div>
                `).join('')}
              </div>

              <div class="pt-3">
                <button onclick="app.navigateTo('lokasi')" class="pb-btn-dark sm:w-auto">
                  <span>📍</span> Buka Petunjuk Arah & Peta
                </button>
              </div>
            </div>

            <div class="lg:col-span-5">
              <div class="pb-img-placeholder h-56 w-full rounded-2xl bg-slate-200/80 text-4xl shadow-inner flex flex-col items-center justify-center">
                <span class="animate-bounce">📍</span>
                <span class="text-xs font-bold text-slate-700 mt-2">Workshop & Butik Daur Ulang</span>
                <span class="text-[11px] text-slate-500">Yogyakarta, Indonesia</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    `;
  }

  /* ==========================================================================
     PAGE 2: ALUR PROSES PRODUKSI (5 TAHAP)
     ========================================================================== */
  renderPageAlurProses() {
    return `
      <div class="space-y-8">
        <div class="pb-hero-banner">
          <div class="max-w-2xl space-y-3">
            <h1 class="text-2xl sm:text-4xl font-extrabold text-white">Alur Proses Produksi</h1>
            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
              Lihat langsung bagaimana sampah kemasan plastik multilayer dan sachet diubah secara higienis menjadi produk fungsional dan karya seni bernilai tinggi.
            </p>
          </div>
        </div>

        <!-- Video Preview Showcase -->
        <div class="pb-card p-6 sm:p-8 text-center bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50 border-emerald-200">
          <div class="max-w-md mx-auto space-y-3">
            <div class="w-16 h-16 rounded-full bg-emerald-700 text-white shadow-xl flex items-center justify-center text-2xl mx-auto cursor-pointer hover:scale-105 transition" onclick="app.showToast('Memutar video dokumentasi proses...')">
              ▶️
            </div>
            <h3 class="font-bold text-base text-slate-900">Video Dokumentasi Proses Pengolahan</h3>
            <p class="text-xs text-slate-500">
              Durasi 2:15 Menit • Menampilkan teknik pencucian higienis, pencacahan, pengepresan panas, hingga finishing oleh pengrajin.
            </p>
          </div>
        </div>

        <!-- 5 Steps Responsive Grid: 1 Col Mobile, 2 Cols Tablet, 3-5 Cols Desktop -->
        <div>
          <h2 class="font-extrabold text-xl text-slate-900 mb-6">5 Tahap Pengolahan Sirkular</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            ${PB_DATA.productionSteps.map(step => `
              <div class="pb-card flex flex-col justify-between space-y-4 relative">
                <div>
                  <div class="flex items-center justify-between mb-3">
                    <span class="w-8 h-8 rounded-full bg-emerald-700 text-white font-extrabold text-sm flex items-center justify-center">
                      ${step.step}
                    </span>
                    <span class="text-xs font-semibold bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full">
                      ${step.time}
                    </span>
                  </div>

                  <div class="pb-img-placeholder h-36 w-full rounded-2xl bg-emerald-100 text-3xl mb-4">
                    ${step.icon}
                    <span class="text-xs font-semibold text-emerald-900 mt-2">${step.imageLabel}</span>
                  </div>

                  <h3 class="font-bold text-base text-slate-900 mb-1.5">${step.title}</h3>
                  <p class="text-xs text-slate-600 leading-relaxed">${step.desc}</p>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                  <span class="text-slate-400">Stasiun Kerja:</span>
                  <span class="font-bold text-slate-800">${step.station}</span>
                </div>
              </div>
            `).join('')}
          </div>
        </div>

        <div class="text-center pt-4">
          <button onclick="app.setRole('depositor', 'prosedur-penyetoran')" class="pb-btn-primary sm:w-auto px-8">
            Berkontribusi Sekarang: Setor Sampah Anda →
          </button>
        </div>
      </div>
    `;
  }

  /* ==========================================================================
     PAGE 3: KATALOG PRODUK
     ========================================================================== */
  renderPageProduk() {
    return `
      <div class="space-y-6 sm:space-y-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h1 class="font-extrabold text-2xl sm:text-3xl text-slate-900">Katalog Produk</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Dibuat dari bahan baku daur ulang sampah plastik berkualitas tinggi</p>
          </div>
          <span class="text-xs font-bold bg-slate-200 text-slate-700 px-3 py-1.5 rounded-full self-start sm:self-auto">
            ${PB_DATA.products.length} Produk Tersedia
          </span>
        </div>

        <!-- Grid 2-4 Kolom -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
          ${PB_DATA.products.map(prod => `
            <div onclick="app.navigateTo('detail-produk', PB_DATA.products.find(p => p.id === '${prod.id}'))" class="pb-card pb-card-interactive flex flex-col justify-between">
              <div>
                <div class="pb-img-placeholder h-40 sm:h-48 w-full mb-3 rounded-2xl text-4xl sm:text-5xl">
                  ${prod.imageIcon}
                </div>
                <span class="text-[10px] sm:text-[11px] font-semibold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full inline-block mb-1.5">
                  ${prod.category}
                </span>
                <h3 class="font-bold text-sm text-slate-900 line-clamp-1 mb-1">${prod.name}</h3>
                <p class="text-xs text-slate-500 line-clamp-2 mb-3 leading-relaxed">${prod.description}</p>
              </div>
              <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="font-extrabold text-sm sm:text-base text-slate-900">${prod.priceFormatted}</span>
                <span class="text-xs font-bold text-emerald-700">Beli ›</span>
              </div>
            </div>
          `).join('')}
        </div>
      </div>
    `;
  }

  /* ==========================================================================
     PAGE 4: DETAIL PRODUK (2-COLUMNS ON DESKTOP)
     ========================================================================== */
  renderPageDetailProduk() {
    const p = this.selectedProduct;
    return `
      <div class="space-y-6">
        <button onclick="app.navigateTo('produk')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Katalog Produk
        </button>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <!-- Left: Big Product Image Showcase -->
          <div class="lg:col-span-6">
            <div class="pb-img-placeholder h-72 sm:h-96 w-full rounded-3xl bg-emerald-100 text-7xl shadow-inner">
              ${p.imageIcon}
            </div>
          </div>

          <!-- Right: Specs, Color Selection, Order CTA -->
          <div class="lg:col-span-6 space-y-6">
            <div>
              <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-wider">
                ${p.category}
              </span>
              <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">${p.name}</h1>
              <p class="text-2xl font-black text-emerald-800 mt-2">${p.priceFormatted}</p>
              <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                ${p.description}
              </p>
            </div>

            <!-- Color Options -->
            <div class="space-y-2">
              <label class="font-bold text-xs text-slate-800">Pilihan Warna</label>
              <div class="flex gap-2">
                ${p.colorOptions.map((c, i) => `
                  <button onclick="app.selectProductColor('${c}', this)" class="px-4 py-2 rounded-full text-xs font-semibold border ${i === 0 ? 'border-slate-800 bg-slate-900 text-white' : 'border-slate-300 bg-white text-slate-700'}">
                    ${c}
                  </button>
                `).join('')}
              </div>
            </div>

            <!-- Specs Table Card -->
            <div class="pb-card p-5 space-y-3 bg-white">
              <div class="flex justify-between text-xs py-1.5 border-b border-slate-100">
                <span class="text-slate-500">Material Bahan</span>
                <span class="font-bold text-slate-800">${p.material}</span>
              </div>
              <div class="flex justify-between text-xs py-1.5 border-b border-slate-100">
                <span class="text-slate-500">Dimensi Ukuran</span>
                <span class="font-bold text-slate-800">${p.dimensions}</span>
              </div>
              <div class="flex justify-between text-xs py-1.5">
                <span class="text-slate-500">Ketersediaan Stok</span>
                <span class="font-bold text-emerald-700">${p.stock} unit siap kirim</span>
              </div>
            </div>

            <div>
              <button onclick="app.orderProductWhatsapp('${p.name}')" class="pb-btn-dark w-full py-3.5 text-sm">
                <span>💬</span> Pesan Langsung via WhatsApp
              </button>
              <p class="text-center text-[11px] text-slate-400 mt-2">Dukungan transaksi aman dan pengiriman ke seluruh Indonesia.</p>
            </div>
          </div>

        </div>
      </div>
    `;
  }

  selectProductColor(color, btn) {
    btn.parentElement.querySelectorAll('button').forEach(b => {
      b.className = 'px-4 py-2 rounded-full text-xs font-semibold border border-slate-300 bg-white text-slate-700';
    });
    btn.className = 'px-4 py-2 rounded-full text-xs font-semibold border border-slate-800 bg-slate-900 text-white';
    this.showToast(`Warna terpilih: ${color}`);
  }

  orderProductWhatsapp(productName) {
    const text = encodeURIComponent(`Halo Project B Indonesia, saya tertarik memesan produk "${productName}". Mohon informasi pemesanan.`);
    window.open(`https://wa.me/6281234567892?text=${text}`, '_blank');
    this.showToast('Membuka kontak WhatsApp...');
  }

  /* ==========================================================================
     PAGE 5: WORKSHOP LIST & DETAIL
     ========================================================================== */
  renderPageWorkshop() {
    return `
      <div class="space-y-6 sm:space-y-8">
        <div>
          <h1 class="font-extrabold text-2xl sm:text-3xl text-slate-900">Events & Workshop</h1>
          <p class="text-xs sm:text-sm text-slate-500 mt-1">Belajar teknik daur ulang dan ekonomi sirkular langsung bersama instruktur berpengalaman</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          ${PB_DATA.workshops.map(ws => `
            <div onclick="app.navigateTo('detail-workshop', PB_DATA.workshops.find(w => w.id === '${ws.id}'))" class="pb-card pb-card-interactive flex flex-col justify-between space-y-4">
              <div>
                <div class="pb-img-placeholder h-44 w-full rounded-2xl bg-emerald-100 text-5xl mb-4">
                  ${ws.imageIcon}
                </div>
                <div class="flex items-center justify-between mb-2">
                  <span class="text-xs px-2.5 py-1 rounded-md bg-slate-100 font-bold text-slate-700">${ws.date}</span>
                  <span class="badge-pending text-[10px]">Sisa ${ws.remainingSeats} kursi</span>
                </div>
                <h3 class="font-bold text-base text-slate-900 leading-snug mb-1">
                  ${ws.title}
                </h3>
                <p class="text-xs text-slate-500">${ws.series}</p>
                <p class="text-xs text-slate-600 mt-2 line-clamp-2">${ws.description}</p>
              </div>

              <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="font-extrabold text-sm text-emerald-700">${ws.price}</span>
                <span class="text-xs font-bold text-slate-700">Lihat Silabus →</span>
              </div>
            </div>
          `).join('')}
        </div>
      </div>
    `;
  }

  renderPageDetailWorkshop() {
    const ws = this.selectedWorkshop;
    return `
      <div class="space-y-6">
        <button onclick="app.navigateTo('workshop')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Daftar Workshop
        </button>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <!-- Left Column: Details & Registration -->
          <div class="lg:col-span-5 space-y-6">
            <div class="pb-img-placeholder h-56 w-full rounded-3xl bg-emerald-100 text-6xl">
              ${ws.imageIcon}
            </div>

            <div class="pb-card p-5 space-y-3">
              <h2 class="font-bold text-base text-slate-900">Informasi Pelaksanaan</h2>
              <div class="divide-y divide-slate-100 text-xs">
                <div class="flex justify-between py-2">
                  <span class="text-slate-500">Tanggal</span>
                  <span class="font-bold text-slate-900">${ws.date}</span>
                </div>
                <div class="flex justify-between py-2">
                  <span class="text-slate-500">Waktu</span>
                  <span class="font-bold text-slate-900">${ws.time}</span>
                </div>
                <div class="flex justify-between py-2">
                  <span class="text-slate-500">Total Kuota</span>
                  <span class="font-bold text-slate-900">${ws.quota} Peserta (${ws.remainingSeats} sisa)</span>
                </div>
                <div class="flex justify-between py-2">
                  <span class="text-slate-500">Biaya Investasi</span>
                  <span class="font-extrabold text-emerald-700">${ws.price}</span>
                </div>
                <div class="flex justify-between py-2">
                  <span class="text-slate-500">Instruktur</span>
                  <span class="font-bold text-slate-900">${ws.instructor}</span>
                </div>
              </div>

              <div class="pt-3">
                <button onclick="app.showToast('Membuka tautan pendaftaran Lynk.id...')" class="pb-btn-primary w-full py-3">
                  Daftar Sekarang (Lynk.id) →
                </button>
              </div>
            </div>
          </div>

          <!-- Right Column: 15 Syllabus Topics & Target Audience -->
          <div class="lg:col-span-7 space-y-6">
            <div>
              <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">${ws.series}</span>
              <h1 class="text-2xl font-extrabold text-slate-900 mt-1 leading-snug">${ws.title}</h1>
              <p class="text-sm text-slate-600 mt-3 leading-relaxed">${ws.description}</p>
            </div>

            <div class="space-y-3">
              <h3 class="font-extrabold text-base text-slate-900 flex items-center gap-2">
                <span>📖</span> 15 Materi yang Dipelajari:
              </h3>
              <div class="bg-white p-6 rounded-3xl border border-slate-200 divide-y divide-slate-100 text-xs text-slate-700">
                ${ws.syllabus.map(item => `
                  <div class="py-2.5 leading-relaxed">${item}</div>
                `).join('')}
              </div>
            </div>

            <div class="pb-card p-5 bg-emerald-50/50 border-emerald-100">
              <h4 class="font-bold text-xs text-emerald-950 mb-1">🎯 Sasaran Peserta:</h4>
              <p class="text-xs text-emerald-900 leading-relaxed">${ws.targetAudience}</p>
            </div>
          </div>

        </div>
      </div>
    `;
  }

  /* ==========================================================================
     PAGE 6: PENGHARGAAN, SERTIFIKAT, TESTIMONI
     ========================================================================== */
  renderPagePenghargaan() {
    return `
      <div class="space-y-10">
        <div class="pb-hero-banner">
          <div class="max-w-2xl space-y-3">
            <h1 class="text-2xl sm:text-4xl font-extrabold text-white">Penghargaan & Pengakuan</h1>
            <p class="text-emerald-100 text-sm sm:text-base leading-relaxed">
              Dipercaya pemerintah kota, dinas lingkungan hidup, lembaga sertifikasi, dan ratusan warga dalam upaya nyata pengurangan sampah plastik.
            </p>
          </div>
        </div>

        <!-- 2 Columns: Penghargaan vs Kepercayaan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          
          <!-- Awards Column -->
          <div class="space-y-4">
            <h2 class="font-extrabold text-lg text-slate-900">Semua Penghargaan yang Diterima</h2>
            <div class="space-y-3">
              ${PB_DATA.certificates.map(cert => `
                <div onclick="app.navigateTo('detail-sertifikat', PB_DATA.certificates.find(c => c.id === '${cert.id}'))" class="pb-card pb-card-interactive flex items-center justify-between p-4">
                  <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-2xl flex-shrink-0">
                      ${cert.icon}
                    </div>
                    <div>
                      <h3 class="font-bold text-sm text-slate-900">${cert.title}</h3>
                      <p class="text-xs text-slate-500">${cert.issuer} · ${cert.year}</p>
                    </div>
                  </div>
                  <span class="text-xs font-bold text-emerald-700">Lihat ›</span>
                </div>
              `).join('')}
            </div>
          </div>

          <!-- Trust Reasons Column -->
          <div class="space-y-4">
            <h2 class="font-extrabold text-lg text-slate-900">Kenapa Percaya Kami?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
              ${PB_DATA.trustReasons.map(tr => `
                <div class="pb-card p-4 space-y-2">
                  <span class="text-2xl">${tr.icon}</span>
                  <h3 class="font-bold text-xs text-slate-900">${tr.title}</h3>
                  <p class="text-xs text-slate-500 leading-relaxed">${tr.desc}</p>
                </div>
              `).join('')}
            </div>
          </div>

        </div>

        <!-- Testimonials -->
        <div class="space-y-4">
          <h2 class="font-extrabold text-lg text-slate-900">Kata Mereka</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            ${PB_DATA.testimonials.map(t => `
              <div class="pb-card p-6 space-y-3">
                <div class="text-amber-400 text-sm tracking-wider">★★★★★</div>
                <p class="text-xs sm:text-sm text-slate-700 italic leading-relaxed">"${t.text}"</p>
                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                  <span class="font-bold text-slate-900">${t.author}</span>
                  <span class="text-slate-400">${t.role}</span>
                </div>
              </div>
            `).join('')}
          </div>
        </div>
      </div>
    `;
  }

  renderPageDetailSertifikat() {
    const c = this.selectedCertificate;
    return `
      <div class="max-w-2xl mx-auto space-y-6">
        <button onclick="app.navigateTo('penghargaan')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Penghargaan
        </button>

        <div class="h-64 sm:h-80 w-full rounded-3xl p-8 flex flex-col justify-between text-white shadow-xl" style="background: linear-gradient(135deg, #0d3b66 0%, #006466 50%, #06d6a0 100%);">
          <div class="flex justify-between items-start">
            <span class="text-4xl">📜</span>
            <span class="bg-white/20 backdrop-blur-md px-3.5 py-1 rounded-full text-xs font-semibold">${c.year}</span>
          </div>
          <div>
            <p class="text-xs uppercase tracking-widest text-emerald-200 font-bold mb-1">${c.issuer}</p>
            <h2 class="text-2xl sm:text-3xl font-extrabold">${c.title}</h2>
          </div>
        </div>

        <div class="pb-card p-6 space-y-4">
          <h1 class="text-xl font-bold text-slate-900">${c.title}</h1>
          <p class="text-xs font-semibold text-slate-500">${c.issuer} · ${c.year} · Kategori ${c.type}</p>
          <p class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-200">
            ${c.description}
          </p>
          <p class="text-xs text-emerald-800 bg-emerald-50 p-3 rounded-xl border border-emerald-200 font-semibold">
            ℹ️ ${c.latestInfo}
          </p>
        </div>
      </div>
    `;
  }

  /* ==========================================================================
     PAGE 7: LOKASI & KONTAK
     ========================================================================== */
  renderPageLokasi() {
    return `
      <div class="max-w-4xl mx-auto space-y-6">
        <div>
          <h1 class="font-extrabold text-2xl sm:text-3xl text-slate-900">Lokasi Setor & Workshop</h1>
          <p class="text-xs sm:text-sm text-slate-500 mt-1">Kunjungi workshop kami untuk mengantarkan sampah atau berbelanja produk</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          <div class="lg:col-span-7">
            <div class="pb-img-placeholder h-72 sm:h-96 w-full rounded-3xl bg-slate-200 text-5xl shadow-inner relative flex flex-col items-center justify-center">
              <span class="animate-bounce">📍</span>
              <span class="text-xs font-bold text-slate-700 mt-2">Peta Interaktif Lokasi Butik</span>
            </div>
          </div>

          <div class="lg:col-span-5 pb-card p-6 space-y-5">
            <div>
              <h2 class="font-bold text-base text-slate-900">${PB_DATA.location.name}</h2>
              <p class="text-xs text-slate-500 mt-1">${PB_DATA.location.address}</p>
            </div>

            <div class="space-y-2 pt-2 border-t border-slate-100 text-xs">
              <h3 class="font-bold text-slate-700 mb-2">Jam Buka Drop-Point:</h3>
              ${PB_DATA.location.hours.map(h => `
                <div class="flex justify-between py-1.5 border-b border-slate-50">
                  <span class="text-slate-600">${h.day}</span>
                  <span class="font-bold text-slate-900">${h.time}</span>
                </div>
              `).join('')}
            </div>

            <button onclick="app.showToast('Membuka rute Google Maps...')" class="pb-btn-dark w-full">
              Buka di Google Maps
            </button>
          </div>
        </div>
      </div>
    `;
  }

  renderPageKontak() {
    return `
      <div class="max-w-3xl mx-auto space-y-8">
        <div class="text-center space-y-2">
          <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900">Hubungi Kami</h1>
          <p class="text-xs sm:text-sm text-slate-500">Silakan hubungi tim kami untuk konsultasi penjemputan sampah, kemitraan, atau produk</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          ${PB_DATA.contacts.map(c => `
            <a href="${c.link}" target="_blank" class="pb-card pb-card-interactive p-5 flex items-center gap-4 block text-decoration-none">
              <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-2xl flex-shrink-0">
                ${c.icon}
              </div>
              <div class="flex-grow">
                <h3 class="font-bold text-xs sm:text-sm text-slate-900">${c.name}</h3>
                <p class="text-xs text-slate-500">${c.desc}</p>
              </div>
              <span class="text-slate-300">›</span>
            </a>
          `).join('')}
        </div>
      </div>
    `;
  }

  /* ==========================================================================
     PAGE 8: AUTHENTICATION (LOGIN & REGISTER)
     ========================================================================== */
  renderPageLogin() {
    return `
      <div class="max-w-md mx-auto space-y-6 py-6">
        <div class="text-center space-y-2">
          <div class="flex items-center justify-center gap-2">
            <span class="text-3xl">♻️</span>
            <span class="font-extrabold text-2xl text-slate-900">Project B Indonesia</span>
          </div>
          <p class="text-xs text-slate-500">Masuk untuk setor plastik atau belanja produk.</p>
        </div>

        <!-- Role Quick Switcher -->
        <div class="flex bg-slate-100 p-1 rounded-xl text-xs font-semibold">
          <button type="button" id="login-role-penyetor" onclick="app.setLoginTab('penyetor')" class="flex-1 py-2 rounded-lg bg-white shadow-sm text-slate-800">
            Penyetor
          </button>
          <button type="button" id="login-role-admin" onclick="app.setLoginTab('admin')" class="flex-1 py-2 rounded-lg text-slate-500 hover:text-slate-800">
            Admin
          </button>
        </div>

        <form onsubmit="app.handleLoginSubmit(event)" class="pb-card p-6 space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Email / No. HP</label>
            <input type="text" id="login-identifier" class="pb-input" value="rina@email.com" placeholder="nama@email.com" required />
          </div>

          <div>
            <div class="flex justify-between items-center mb-1">
              <label class="block text-xs font-bold text-slate-700">Kata sandi</label>
              <button type="button" onclick="app.showToast('Tautan reset kata sandi dikirim')" class="text-xs text-slate-400 hover:text-slate-600">Lupa sandi?</button>
            </div>
            <div class="relative">
              <input type="password" id="login-password" class="pb-input" value="password" required />
              <button type="button" onclick="app.togglePasswordVisibility('login-password')" class="absolute right-3 top-3 text-xs text-slate-400">👁️</button>
            </div>
          </div>

          <button type="submit" class="pb-btn-primary w-full py-3">
            Masuk
          </button>

          <div class="relative flex py-2 items-center">
            <div class="flex-grow border-t border-slate-200"></div>
            <span class="flex-shrink mx-3 text-slate-400 text-xs">Atau</span>
            <div class="flex-grow border-t border-slate-200"></div>
          </div>

          <button type="button" onclick="app.handleGoogleLogin()" class="w-full py-3 rounded-full text-xs font-semibold bg-emerald-100/70 text-emerald-800 hover:bg-emerald-200/80 transition flex items-center justify-center gap-2">
            <span>🌐</span> Masuk dengan Google
          </button>
        </form>

        <div class="text-center text-xs text-slate-500">
          Belum punya akun? 
          <button onclick="app.navigateTo('register')" class="font-bold text-emerald-700 hover:underline">
            Daftar Akun Baru
          </button>
        </div>
      </div>
    `;
  }

  setLoginTab(role) {
    const pBtn = document.getElementById('login-role-penyetor');
    const aBtn = document.getElementById('login-role-admin');
    const idInput = document.getElementById('login-identifier');
    if (role === 'admin') {
      aBtn.className = 'flex-1 py-2 rounded-lg bg-white shadow-sm text-slate-800 font-bold';
      pBtn.className = 'flex-1 py-2 rounded-lg text-slate-500 hover:text-slate-800';
      idInput.value = 'admin@projectb.id';
    } else {
      pBtn.className = 'flex-1 py-2 rounded-lg bg-white shadow-sm text-slate-800 font-bold';
      aBtn.className = 'flex-1 py-2 rounded-lg text-slate-500 hover:text-slate-800';
      idInput.value = 'rina@email.com';
    }
  }

  togglePasswordVisibility(id) {
    const el = document.getElementById(id);
    if (el) el.type = el.type === 'password' ? 'text' : 'password';
  }

  handleLoginSubmit(e) {
    e.preventDefault();
    const idVal = document.getElementById('login-identifier').value;
    if (idVal.includes('admin')) {
      this.setRole('admin', 'admin-beranda');
    } else {
      this.setRole('depositor', 'prosedur-penyetoran');
    }
  }

  handleGoogleLogin() {
    this.showToast('Login Google simulasi berhasil!');
    this.setRole('depositor', 'prosedur-penyetoran');
  }

  renderPageRegister() {
    return `
      <div class="max-w-md mx-auto space-y-6 py-6">
        <div class="text-center space-y-2">
          <div class="flex items-center justify-center gap-2">
            <span class="text-3xl">♻️</span>
            <span class="font-extrabold text-2xl text-slate-900">Project B Indonesia</span>
          </div>
          <p class="text-xs text-slate-500">Daftar sebagai penyetor plastik.</p>
        </div>

        <form onsubmit="app.handleRegisterSubmit(event)" class="pb-card p-6 space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama lengkap</label>
            <input type="text" id="reg-name" class="pb-input" value="Rina Wulandari" required />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">No. HP / WhatsApp</label>
            <input type="text" id="reg-phone" class="pb-input" value="0812-0000-0000" required />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Alamat penjemputan</label>
            <input type="text" id="reg-address" class="pb-input" value="Jl. Melati No. 5, Yogyakarta" required />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kata sandi</label>
            <input type="password" id="reg-pwd" class="pb-input" value="password" required />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi kata sandi</label>
            <input type="password" id="reg-cpwd" class="pb-input" value="password" required />
          </div>

          <button type="submit" class="pb-btn-dark w-full py-3">
            Daftar
          </button>
        </form>

        <div class="text-center text-xs text-slate-500">
          Sudah punya akun? 
          <button onclick="app.navigateTo('login')" class="font-bold text-emerald-700 hover:underline">
            Masuk
          </button>
        </div>
      </div>
    `;
  }

  handleRegisterSubmit(e) {
    e.preventDefault();
    const name = document.getElementById('reg-name').value;
    PB_DATA.user.name = name;
    this.showToast('Pendaftaran berhasil!');
    this.setRole('depositor', 'prosedur-penyetoran');
  }

  /* ==========================================================================
     PAGE 9: PENYETOR (DEPOSITOR) - PROSEDUR & FORM
     ========================================================================== */
  renderPageProsedurPenyetoran() {
    return `
      <div class="space-y-8">
        
        <!-- Welcome Banner -->
        <div class="pb-card p-6 bg-gradient-to-r from-emerald-800 to-teal-800 text-white rounded-3xl">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
              <p class="text-xs text-emerald-200">Halo, ${PB_DATA.user.name} 👋</p>
              <h1 class="text-xl sm:text-2xl font-black text-white mt-1">Prosedur Penyetoran Sampah</h1>
              <p class="text-xs sm:text-sm text-emerald-100 mt-1">Pilah sampah dengan bersih dan kumpulkan poin reward setiap kg.</p>
            </div>
            <button onclick="app.navigateTo('form-setor')" class="bg-white text-emerald-950 font-bold px-6 py-3 rounded-full text-xs hover:bg-emerald-50 transition shadow-lg self-start sm:self-auto">
              Setor Sekarang →
            </button>
          </div>
        </div>

        <!-- 2 Columns: Jenis Sampah & Kondisi Wajib -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          
          <div class="space-y-3">
            <h2 class="font-extrabold text-base text-slate-900">Yang Bisa Disetor</h2>
            
            <div class="space-y-3">
              <div onclick="app.navigateTo('detail-sampah', PB_DATA.wasteTypes[0])" class="pb-card pb-card-interactive p-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <span class="text-3xl">🍜</span>
                  <div>
                    <h3 class="font-bold text-sm text-slate-900">Kemasan Multilayer</h3>
                    <p class="text-xs text-slate-500 leading-snug">Bungkus mie instan, sachet minuman, detergen, minyak goreng.</p>
                  </div>
                </div>
                <span class="badge-success text-xs font-bold">10 poin/kg</span>
              </div>

              <div onclick="app.navigateTo('detail-sampah', PB_DATA.wasteTypes[1])" class="pb-card pb-card-interactive p-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <span class="text-3xl">🛢️</span>
                  <div>
                    <h3 class="font-bold text-sm text-slate-900">Minyak Jelantah</h3>
                    <p class="text-xs text-slate-500 leading-snug">Simpan di wadah tertutup rapat tanpa sisa makanan.</p>
                  </div>
                </div>
                <span class="badge-success text-xs font-bold">10 poin/liter</span>
              </div>
            </div>
          </div>

          <div class="space-y-3">
            <h2 class="font-extrabold text-base text-slate-900">Ketentuan Kualitas</h2>
            <div class="bg-amber-50 border border-amber-200 rounded-3xl p-5 space-y-2">
              <div class="flex items-center gap-2 font-bold text-xs text-amber-900">
                <span class="text-lg">⚠️</span> Kondisi Wajib
              </div>
              <p class="text-xs text-amber-800 leading-relaxed">
                Sampah harus dalam keadaan <strong>kosong, bersih, dan kering</strong>, tidak bercampur air atau sisa makanan hewani, serta bukan berasal dari produk non-halal.
              </p>
              <p class="text-[11px] text-amber-700/80 pt-1">
                Kondisi yang bersih memudahkan pengrajin memproses tanpa bau dan menghasilkan kerajinan yang kuat.
              </p>
            </div>
          </div>

        </div>

        <!-- 4 Langkah & Metode Serah -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <div class="lg:col-span-8 space-y-4">
            <h2 class="font-extrabold text-base text-slate-900">4 Langkah Penyetoran</h2>
            <div class="pb-card p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
              <div class="flex items-start gap-3">
                <span class="w-7 h-7 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">1</span>
                <div>
                  <h4 class="font-bold text-xs text-slate-900">Siapkan Sampah</h4>
                  <p class="text-xs text-slate-500 mt-0.5">Pilah per jenis dan pastikan bersih serta kering.</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <span class="w-7 h-7 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">2</span>
                <div>
                  <h4 class="font-bold text-xs text-slate-900">Isi Data Setoran</h4>
                  <p class="text-xs text-slate-500 mt-0.5">Tentukan jenis, perkiraan jumlah, dan cara serah.</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <span class="w-7 h-7 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">3</span>
                <div>
                  <h4 class="font-bold text-xs text-slate-900">Serahkan</h4>
                  <p class="text-xs text-slate-500 mt-0.5">Drop langsung ke butik atau kirim melalui kurir.</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <span class="w-7 h-7 rounded-full bg-emerald-700 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">4</span>
                <div>
                  <h4 class="font-bold text-xs text-slate-900">Tunggu Verifikasi</h4>
                  <p class="text-xs text-slate-500 mt-0.5">Admin menimbang dan poin otomatis masuk.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="lg:col-span-4 space-y-4">
            <h2 class="font-extrabold text-base text-slate-900">Cara Menyerahkan</h2>
            <div class="pb-card p-5 space-y-3">
              <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100">
                <p class="font-bold text-xs text-slate-900 flex items-center gap-1.5">
                  <span>🏪</span> Drop Langsung
                </p>
                <p class="text-xs text-slate-500 mt-1">Butik Daur Ulang, Jl. Contoh No. 12</p>
                <p class="text-[10px] text-slate-400">Senin–Sabtu: 08.00–20.00 WIB</p>
              </div>

              <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100">
                <p class="font-bold text-xs text-slate-900 flex items-center gap-1.5">
                  <span>🚚</span> Kirim Via Kurir
                </p>
                <p class="text-xs text-slate-500 mt-1">Ekspedisi ke alamat workshop Project B</p>
                <button onclick="app.navigateTo('lokasi')" class="text-[11px] font-bold text-emerald-700 mt-1 block">Lihat Alamat Lengkap →</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    `;
  }

  renderPageDetailSampah() {
    const w = this.selectedWasteDetail;
    return `
      <div class="max-w-2xl mx-auto space-y-6">
        <button onclick="app.navigateTo('prosedur-penyetoran')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Prosedur Penyetoran
        </button>

        <div class="pb-img-placeholder h-56 w-full rounded-3xl bg-emerald-100 text-6xl">
          ${w.icon}
        </div>

        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-2xl font-extrabold text-slate-900">${w.name}</h1>
              <p class="text-xs text-slate-500 mt-0.5">${w.subtitle}</p>
            </div>
            <span class="badge-success text-sm font-bold">10 Poin / ${w.unit}</span>
          </div>

          <div class="pb-card p-5 space-y-2">
            <h3 class="font-bold text-xs text-slate-800">Contoh barang yang diterima:</h3>
            <p class="text-xs text-slate-600 leading-relaxed">${w.examples}</p>
          </div>

          <div class="pb-card p-5 space-y-2 bg-emerald-50/50 border-emerald-100">
            <h3 class="font-bold text-xs text-emerald-950 flex items-center gap-1.5">
              <span>✔</span> Cara Menyiapkan
            </h3>
            <p class="text-xs text-emerald-900 leading-relaxed">${w.prepGuide}</p>
          </div>

          <button onclick="app.navigateTo('form-setor')" class="pb-btn-dark w-full py-3.5">
            Setor ${w.name} Sekarang
          </button>
        </div>
      </div>
    `;
  }

  renderPageFormSetor() {
    return `
      <div class="max-w-2xl mx-auto space-y-6">
        <button onclick="app.navigateTo('prosedur-penyetoran')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Panduan
        </button>

        <div class="pb-card p-6 sm:p-8 space-y-6">
          <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Form Setor Sampah</h1>
            <p class="text-xs text-slate-500 mt-1">Masukkan perkiraan berat dan metode serah untuk diteruskan ke admin</p>
          </div>

          <form onsubmit="app.handleFormSetorSubmit(event)" class="space-y-5">
            <!-- Jenis Sampah -->
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-2">Jenis Sampah</label>
              <div class="grid grid-cols-2 gap-3">
                <label class="border rounded-2xl p-4 flex flex-col items-center text-center cursor-pointer transition border-emerald-600 bg-emerald-50/50" id="type-opt-1">
                  <input type="radio" name="wasteType" value="Kemasan Multilayer" checked onchange="app.updateFormCalculations()" class="sr-only">
                  <span class="text-3xl mb-1">🍜</span>
                  <span class="text-xs font-bold text-slate-900">Kemasan Multilayer</span>
                  <span class="text-[10px] text-emerald-700 font-semibold mt-0.5">10 poin/kg</span>
                </label>

                <label class="border rounded-2xl p-4 flex flex-col items-center text-center cursor-pointer transition border-slate-200" id="type-opt-2">
                  <input type="radio" name="wasteType" value="Minyak Jelantah" onchange="app.updateFormCalculations()" class="sr-only">
                  <span class="text-3xl mb-1">🛢️</span>
                  <span class="text-xs font-bold text-slate-900">Minyak Jelantah</span>
                  <span class="text-[10px] text-emerald-700 font-semibold mt-0.5">10 poin/liter</span>
                </label>
              </div>
            </div>

            <!-- Jumlah -->
            <div>
              <div class="flex justify-between items-center mb-1">
                <label class="block text-xs font-bold text-slate-700">Perkiraan Jumlah</label>
                <span id="unit-label" class="text-xs font-semibold text-emerald-700">(kg)</span>
              </div>
              <input type="number" step="0.5" min="0.5" id="form-amount" value="2.5" oninput="app.updateFormCalculations()" class="pb-input font-bold text-base" required />
            </div>

            <!-- Estimasi Poin Box -->
            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center justify-between">
              <span class="text-xs font-semibold text-emerald-900">Estimasi Poin Reward:</span>
              <span id="est-points" class="font-extrabold text-base text-emerald-700">+25 Poin</span>
            </div>

            <!-- Metode Penyerahan -->
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-2">Metode Penyerahan</label>
              <div class="space-y-2">
                <label class="flex items-center gap-3 p-3.5 border rounded-2xl cursor-pointer hover:bg-slate-50 border-slate-300">
                  <input type="radio" name="deliveryMethod" value="Drop Langsung (Butik Daur Ulang)" checked class="text-emerald-600 focus:ring-emerald-500" />
                  <div>
                    <span class="text-xs font-bold text-slate-900 block">Drop Langsung ke Butik Daur Ulang</span>
                    <span class="text-[10px] text-slate-500">Jl. Contoh No. 12, Yogyakarta (08.00–20.00)</span>
                  </div>
                </label>
                <label class="flex items-center gap-3 p-3.5 border rounded-2xl cursor-pointer hover:bg-slate-50 border-slate-300">
                  <input type="radio" name="deliveryMethod" value="Via Kurir" class="text-emerald-600 focus:ring-emerald-500" />
                  <div>
                    <span class="text-xs font-bold text-slate-900 block">Kirim via Ekspedisi / Kurir</span>
                    <span class="text-[10px] text-slate-500">Kirim mandiri ke alamat workshop</span>
                  </div>
                </label>
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
              <textarea id="form-notes" rows="2" class="pb-input text-xs" placeholder="Misal: Sudah dipilah dan dikeringkan"></textarea>
            </div>

            <button type="submit" class="pb-btn-primary w-full py-3.5">
              Kirim Pengajuan Setoran →
            </button>
          </form>
        </div>
      </div>
    `;
  }

  updateFormCalculations() {
    const radios = document.getElementsByName('wasteType');
    let selected = 'Kemasan Multilayer';
    for (let r of radios) {
      if (r.checked) selected = r.value;
    }
    const amount = parseFloat(document.getElementById('form-amount')?.value || 0);
    const est = Math.round(amount * 10);
    const estEl = document.getElementById('est-points');
    if (estEl) estEl.innerText = `+${est} Poin`;

    const unitEl = document.getElementById('unit-label');
    if (unitEl) unitEl.innerText = selected === 'Minyak Jelantah' ? '(Liter)' : '(kg)';

    const opt1 = document.getElementById('type-opt-1');
    const opt2 = document.getElementById('type-opt-2');
    if (opt1 && opt2) {
      if (selected === 'Kemasan Multilayer') {
        opt1.className = 'border rounded-2xl p-4 flex flex-col items-center text-center cursor-pointer transition border-emerald-600 bg-emerald-50/50';
        opt2.className = 'border rounded-2xl p-4 flex flex-col items-center text-center cursor-pointer transition border-slate-200';
      } else {
        opt2.className = 'border rounded-2xl p-4 flex flex-col items-center text-center cursor-pointer transition border-emerald-600 bg-emerald-50/50';
        opt1.className = 'border rounded-2xl p-4 flex flex-col items-center text-center cursor-pointer transition border-slate-200';
      }
    }
  }

  handleFormSetorSubmit(e) {
    e.preventDefault();
    const wasteType = document.querySelector('input[name="wasteType"]:checked').value;
    const amountVal = parseFloat(document.getElementById('form-amount').value);
    const method = document.querySelector('input[name="deliveryMethod"]:checked').value;
    const notes = document.getElementById('form-notes').value;

    const newDeposit = {
      id: `STR-${Math.floor(1003 + Math.random() * 900)}`,
      depositorName: PB_DATA.user.name,
      depositorInit: PB_DATA.user.avatar,
      wasteType: wasteType,
      amount: `${amountVal} ${wasteType === 'Minyak Jelantah' ? 'L' : 'kg'}`,
      amountValue: amountVal,
      date: 'Hari ini',
      time: 'Baru saja',
      status: 'Menunggu',
      method: method,
      pointsAwarded: Math.round(amountVal * 10),
      isCurrentUser: true,
      notes: notes || 'Sampah siap diverifikasi',
      steps: [
        { label: 'Setoran dikirim', time: 'Baru saja', done: true },
        { label: 'Menunggu verifikasi admin', time: 'Sedang diperiksa', done: false, current: true },
        { label: 'Diterima atau ditolak', time: 'Hasil akan muncul di sini', done: false },
        { label: 'Poin masuk', time: 'Setelah diterima', done: false }
      ]
    };

    PB_DATA.deposits.unshift(newDeposit);
    PB_DATA.adminSummary.pendingVerifications++;
    this.showToast('Setoran berhasil diajukan!');
    this.navigateTo('detail-setoran', newDeposit);
  }

  /* ==========================================================================
     PAGE 10: RIWAYAT SETORAN & TRACKING (DESKTOP TABLE + MOBILE CARDS)
     ========================================================================== */
  renderPageRiwayat() {
    const userDeposits = PB_DATA.deposits.filter(d => d.isCurrentUser);
    return `
      <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h1 class="font-extrabold text-2xl sm:text-3xl text-slate-900">Riwayat Setoran</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Daftar pengajuan dan status verifikasi setoran Anda</p>
          </div>
          <button onclick="app.navigateTo('form-setor')" class="pb-btn-primary self-start sm:self-auto text-xs py-2.5">
            + Ajukan Setoran Baru
          </button>
        </div>

        <!-- Desktop Wide Table (Hidden on Mobile) -->
        <div class="hidden md:block pb-card p-0 overflow-hidden">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-100">
              <tr>
                <th class="py-3.5 px-6">ID Setoran</th>
                <th class="py-3.5 px-6">Jenis Sampah</th>
                <th class="py-3.5 px-6">Jumlah</th>
                <th class="py-3.5 px-6">Tanggal</th>
                <th class="py-3.5 px-6">Metode</th>
                <th class="py-3.5 px-6">Status</th>
                <th class="py-3.5 px-6 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              ${userDeposits.map(dep => `
                <tr class="hover:bg-slate-50 transition">
                  <td class="py-3.5 px-6 font-bold text-slate-900">#${dep.id}</td>
                  <td class="py-3.5 px-6 font-semibold">${dep.wasteType}</td>
                  <td class="py-3.5 px-6 font-bold text-slate-800">${dep.amount}</td>
                  <td class="py-3.5 px-6 text-slate-500">${dep.date}</td>
                  <td class="py-3.5 px-6 text-slate-500">${dep.method}</td>
                  <td class="py-3.5 px-6">
                    <span class="${dep.status === 'Menunggu' ? 'badge-pending' : dep.status === 'Diterima' ? 'badge-success' : 'badge-danger'}">
                      ${dep.status}
                    </span>
                  </td>
                  <td class="py-3.5 px-6 text-right">
                    <button onclick="app.navigateTo('detail-setoran', PB_DATA.deposits.find(d => d.id === '${dep.id}'))" class="font-bold text-emerald-700 hover:text-emerald-800">
                      Detail ›
                    </button>
                  </td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>

        <!-- Mobile Card Feed (Visible on Mobile) -->
        <div class="md:hidden space-y-3">
          ${userDeposits.map(dep => `
            <div onclick="app.navigateTo('detail-setoran', PB_DATA.deposits.find(d => d.id === '${dep.id}'))" class="pb-card p-4 space-y-2 cursor-pointer">
              <div class="flex items-center justify-between">
                <span class="font-bold text-xs text-slate-900">${dep.wasteType} • ${dep.amount}</span>
                <span class="${dep.status === 'Menunggu' ? 'badge-pending' : dep.status === 'Diterima' ? 'badge-success' : 'badge-danger'}">
                  ${dep.status}
                </span>
              </div>
              <p class="text-[11px] text-slate-400">#${dep.id} • ${dep.date}</p>
            </div>
          `).join('')}
        </div>
      </div>
    `;
  }

  renderPageDetailSetoran() {
    const d = this.selectedDeposit || PB_DATA.deposits[0];
    const isAccepted = d.status === 'Diterima';
    const isCancelled = d.status === 'Dibatalkan';

    return `
      <div class="max-w-2xl mx-auto space-y-6">
        <button onclick="app.navigateTo('riwayat')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Riwayat Setoran
        </button>

        <div class="pb-card p-6 space-y-5">
          <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
              <h2 class="font-extrabold text-base text-slate-900">${d.wasteType} • ${d.amount}</h2>
              <p class="text-xs text-slate-400 mt-0.5">#${d.id} • Diajukan: ${d.date}</p>
            </div>
            <span class="${isAccepted ? 'badge-success' : isCancelled ? 'badge-neutral' : 'badge-pending'} text-xs">
              ${d.status}
            </span>
          </div>

          <!-- Stepper -->
          <div class="space-y-4 pt-2">
            <h3 class="font-bold text-xs text-slate-800">Tahap Pelacakan:</h3>

            <div class="space-y-4">
              <div class="timeline-step ${isAccepted ? 'completed' : ''}">
                <div class="timeline-dot ${isAccepted ? 'active' : 'bg-slate-700'}"></div>
                <p class="font-bold text-xs text-slate-900">Setoran Dikirim</p>
                <p class="text-[11px] text-slate-500">${d.date}, ${d.time}</p>
              </div>

              <div class="timeline-step ${isAccepted ? 'completed' : ''}">
                <div class="timeline-dot ${isAccepted ? 'active' : 'bg-slate-800'}"></div>
                <p class="font-bold text-xs text-slate-900">${isAccepted ? 'Diverifikasi Admin' : 'Menunggu Verifikasi'}</p>
                <p class="text-[11px] text-slate-500">${isAccepted ? 'Telah ditimbang & disetujui' : 'Sedang diperiksa oleh tim verifikator'}</p>
              </div>

              <div class="timeline-step ${isAccepted ? 'completed' : ''}">
                <div class="timeline-dot ${isAccepted ? 'active' : 'bg-slate-400'}"></div>
                <p class="font-bold text-xs text-slate-900">${isAccepted ? 'Diterima' : 'Keputusan Verifikasi'}</p>
                <p class="text-[11px] text-slate-500">${isAccepted ? 'Sesuai standar kebersihan' : 'Hasil akan tampil di sini'}</p>
              </div>

              <div class="timeline-step">
                <div class="timeline-dot ${isAccepted ? 'active' : 'bg-slate-400'}"></div>
                <p class="font-bold text-xs text-slate-900">Poin Masuk</p>
                <p class="text-[11px] text-slate-500">${isAccepted ? `+${d.pointsAwarded} poin telah ditambahkan ke profil Anda` : 'Otomatis masuk setelah disetujui'}</p>
              </div>
            </div>
          </div>

          ${isAccepted ? `
            <div class="bg-emerald-50 rounded-2xl p-5 text-center border border-emerald-200">
              <span class="text-2xl font-black text-emerald-800 block">+${d.pointsAwarded} Poin Diterima 🎉</span>
              <p class="text-xs text-emerald-700 mt-1">Saldo poin Anda otomatis bertambah!</p>
            </div>
          ` : isCancelled ? `
            <div class="bg-rose-50 rounded-2xl p-4 text-center border border-rose-200">
              <p class="text-xs text-rose-700 font-bold">Setoran ini telah dibatalkan.</p>
              <p class="text-xs text-slate-500 mt-0.5">Alasan: ${d.cancelReason || 'Salah isi data'}</p>
            </div>
          ` : `
            <div class="bg-slate-50 p-4 rounded-2xl text-xs text-slate-600 border border-slate-100 flex items-center gap-2">
              <span>ℹ️</span> Estimasi waktu verifikasi 1×24 jam kerja.
            </div>

            <button onclick="app.navigateTo('batal-setoran-modal')" class="pb-btn-outline w-full">
              Batalkan Setoran Ini
            </button>
          `}
        </div>
      </div>
    `;
  }

  renderPageBatalSetoranModal() {
    const d = this.selectedDeposit || PB_DATA.deposits[0];
    return `
      <div class="max-w-md mx-auto space-y-6">
        <div class="pb-card p-6 space-y-5 shadow-2xl">
          <div>
            <h2 class="font-extrabold text-lg text-slate-900">Batalkan setoran ini?</h2>
            <p class="text-xs text-slate-500 mt-1">
              Setoran #${d.id} (${d.wasteType} • ${d.amount}) akan dibatalkan secara permanen.
            </p>
          </div>

          <div class="grid grid-cols-2 gap-2">
            <button onclick="app.selectCancelReason('Salah isi data', this)" class="reason-chip p-3 rounded-xl border border-slate-800 bg-slate-900 text-white text-xs font-semibold">
              Salah isi data
            </button>
            <button onclick="app.selectCancelReason('Jumlah berubah', this)" class="reason-chip p-3 rounded-xl border border-slate-300 bg-white text-slate-700 text-xs font-semibold">
              Jumlah berubah
            </button>
            <button onclick="app.selectCancelReason('Tidak jadi setor', this)" class="reason-chip p-3 rounded-xl border border-slate-300 bg-white text-slate-700 text-xs font-semibold">
              Tidak jadi setor
            </button>
            <button onclick="app.selectCancelReason('Lainnya', this)" class="reason-chip p-3 rounded-xl border border-slate-300 bg-white text-slate-700 text-xs font-semibold">
              Lainnya
            </button>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Catatan (opsional)</label>
            <input type="text" id="cancel-notes" class="pb-input text-xs" placeholder="Tulis alasan pembatalan..." />
          </div>

          <div class="space-y-2 pt-2">
            <button onclick="app.confirmCancelDeposit()" class="pb-btn-dark w-full py-3">
              Ya, Batalkan
            </button>
            <button onclick="app.navigateTo('detail-setoran')" class="pb-btn-outline w-full py-3">
              Tidak, Kembali
            </button>
          </div>
        </div>
      </div>
    `;
  }

  selectCancelReason(reason, btn) {
    this.cancelReason = reason;
    btn.parentElement.querySelectorAll('button').forEach(b => {
      b.className = 'reason-chip p-3 rounded-xl border border-slate-300 bg-white text-slate-700 text-xs font-semibold';
    });
    btn.className = 'reason-chip p-3 rounded-xl border border-slate-800 bg-slate-900 text-white text-xs font-semibold';
  }

  confirmCancelDeposit() {
    if (this.selectedDeposit) {
      this.selectedDeposit.status = 'Dibatalkan';
      this.selectedDeposit.cancelReason = this.cancelReason;
    }
    this.navigateTo('setoran-dibatalkan');
  }

  renderPageSetoranDibatalkan() {
    const d = this.selectedDeposit || PB_DATA.deposits[0];
    return `
      <div class="max-w-md mx-auto space-y-6 text-center py-6">
        <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center text-4xl mx-auto text-slate-600 shadow-inner">
          🗑️
        </div>

        <div>
          <h1 class="text-2xl font-extrabold text-slate-900">Setoran Dibatalkan</h1>
          <p class="text-xs text-slate-500 mt-1">Admin telah diberitahu. Poin Anda tidak mengalami perubahan.</p>
        </div>

        <div class="pb-card p-5 text-left space-y-2">
          <p class="font-bold text-xs text-slate-900">${d.wasteType} • ${d.amount}</p>
          <p class="text-xs text-slate-500">Alasan: ${this.cancelReason}</p>
        </div>

        <div class="space-y-2">
          <button onclick="app.navigateTo('form-setor')" class="pb-btn-dark w-full py-3">
            Ajukan Setor Ulang
          </button>
          <button onclick="app.navigateTo('riwayat')" class="pb-btn-outline w-full py-3">
            Kembali ke Riwayat
          </button>
        </div>
      </div>
    `;
  }

  /* ==========================================================================
     PAGE 11: PERINGKAT & PROFIL PENYETOR
     ========================================================================== */
  renderPagePeringkat() {
    const top5 = PB_DATA.leaderboard.slice(0, 5);
    const podiumP2 = top5[1];
    const podiumP1 = top5[0];
    const podiumP3 = top5[2];
    const podiumP4 = top5[3];
    const podiumP5 = top5[4];

    return `
      <div class="max-w-4xl mx-auto space-y-8">
        <div>
          <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Papan Peringkat Penyetor</h1>
          <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Periode: September 2026 • Klasemen Akumulasi Poin</p>
        </div>

        <!-- Responsive Podium Bar Chart -->
        <div class="pb-card p-6 pt-8 bg-gradient-to-b from-slate-50/50 to-white">
          <div class="grid grid-cols-5 gap-2 sm:gap-4 items-end h-56 text-center">
            
            <div class="flex flex-col items-center justify-end h-full">
              <span class="text-xs font-bold text-indigo-700 mb-1">${podiumP2.initial}</span>
              <span class="text-xs text-slate-600 truncate w-full mb-1">${podiumP2.name.split(' ')[0]}</span>
              <div class="podium-bar podium-2 w-full h-36"><span>2</span></div>
            </div>

            <div class="flex flex-col items-center justify-end h-full">
              <span class="text-xl mb-1">🥇</span>
              <span class="text-xs text-slate-700 truncate w-full mb-1 font-bold">${podiumP1.name.split(' ')[0]}</span>
              <div class="podium-bar podium-1 w-full h-48"><span>1</span></div>
            </div>

            <div class="flex flex-col items-center justify-end h-full">
              <span class="text-xs font-bold text-purple-700 mb-1">${podiumP3.initial}</span>
              <span class="text-xs text-slate-700 truncate w-full mb-1 font-bold">${podiumP3.name.split(' ')[0]}</span>
              <div class="podium-bar podium-3 w-full h-32"><span>3</span></div>
            </div>

            <div class="flex flex-col items-center justify-end h-full">
              <span class="text-xs font-bold text-slate-600 mb-1">${podiumP4.initial}</span>
              <span class="text-xs text-slate-600 truncate w-full mb-1">${podiumP4.name.split(' ')[0]}</span>
              <div class="podium-bar podium-4 w-full h-24"><span>4</span></div>
            </div>

            <div class="flex flex-col items-center justify-end h-full">
              <span class="text-xs font-bold text-slate-600 mb-1">${podiumP5.initial}</span>
              <span class="text-xs text-slate-600 truncate w-full mb-1">${podiumP5.name.split(' ')[0]}</span>
              <div class="podium-bar podium-5 w-full h-16"><span>5</span></div>
            </div>

          </div>
        </div>

        <!-- Leaderboard Table 1-10 -->
        <div class="pb-card p-0 overflow-hidden divide-y divide-slate-100">
          ${PB_DATA.leaderboard.map(item => `
            <div class="p-4 flex items-center justify-between transition ${
              item.isCurrentUser ? 'bg-indigo-50/90 font-bold border-l-4 border-l-indigo-600' : 'hover:bg-slate-50'
            }">
              <div class="flex items-center gap-4">
                <span class="text-sm font-bold text-slate-500 w-5">${item.rank}</span>
                <div class="w-9 h-9 rounded-full ${item.avatarColor} font-bold text-xs flex items-center justify-center">
                  ${item.initial}
                </div>
                <div>
                  <span class="text-sm text-slate-900 block ${item.isCurrentUser ? 'font-black text-indigo-950' : 'font-semibold'}">
                    ${item.name}
                  </span>
                  <span class="text-xs text-slate-400">${item.kg} kg sampah disetor</span>
                </div>
              </div>

              <span class="text-sm font-bold ${item.isCurrentUser ? 'text-indigo-800' : 'text-slate-800'}">
                ${item.points} poin
              </span>
            </div>
          `).join('')}
        </div>
      </div>
    `;
  }

  renderPageProfil() {
    const u = PB_DATA.user;
    return `
      <div class="max-w-xl mx-auto space-y-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Profil Penyetor</h1>

        <div class="pb-card p-6 text-center space-y-3">
          <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-2xl flex items-center justify-center mx-auto shadow-sm">
            ${u.avatar}
          </div>
          <div>
            <h2 class="font-extrabold text-lg text-slate-900">${u.name}</h2>
            <p class="text-xs text-slate-400">Penyetor aktif sejak ${u.joinedDate}</p>
          </div>
        </div>

        <div class="pb-card p-5 grid grid-cols-3 divide-x divide-slate-100 text-center">
          <div>
            <span class="text-xl font-bold text-slate-900 block">${u.totalKgThisMonth.toString().replace('.', ',')}</span>
            <span class="text-xs text-slate-400">kg bulan ini</span>
          </div>
          <div>
            <span class="text-xl font-bold text-slate-900 block">#${u.currentRank}</span>
            <span class="text-xs text-slate-400">peringkat</span>
          </div>
          <div>
            <span class="text-xl font-bold text-slate-900 block">${u.totalPoints}</span>
            <span class="text-xs text-slate-400">total poin</span>
          </div>
        </div>

        <div class="pb-card p-0 overflow-hidden divide-y divide-slate-100">
          <button onclick="app.navigateTo('ubah-profil')" class="w-full p-4 flex items-center justify-between text-left hover:bg-slate-50 transition">
            <span class="text-xs sm:text-sm font-semibold text-slate-800 flex items-center gap-3">
              <span>✏️</span> Ubah Informasi Profil
            </span>
            <span class="text-slate-400">›</span>
          </button>

          <button onclick="app.navigateTo('ubah-sandi')" class="w-full p-4 flex items-center justify-between text-left hover:bg-slate-50 transition">
            <span class="text-xs sm:text-sm font-semibold text-slate-800 flex items-center gap-3">
              <span>🔒</span> Ubah Kata Sandi
            </span>
            <span class="text-slate-400">›</span>
          </button>

          <button onclick="app.navigateTo('lokasi')" class="w-full p-4 flex items-center justify-between text-left hover:bg-slate-50 transition">
            <span class="text-xs sm:text-sm font-semibold text-slate-800 flex items-center gap-3">
              <span>📍</span> Panduan Lokasi Setor
            </span>
            <span class="text-slate-400">›</span>
          </button>

          <button onclick="app.setRole('public', 'beranda')" class="w-full p-4 flex items-center justify-between text-left hover:bg-rose-50 text-rose-600 transition">
            <span class="text-xs sm:text-sm font-semibold flex items-center gap-3">
              <span>🚪</span> Keluar (Logout)
            </span>
            <span class="text-rose-400">›</span>
          </button>
        </div>
      </div>
    `;
  }

  renderPageUbahProfil() {
    const u = PB_DATA.user;
    return `
      <div class="max-w-xl mx-auto space-y-6">
        <button onclick="app.navigateTo('profil')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Profil
        </button>

        <div class="pb-card p-6 space-y-5">
          <h1 class="text-xl font-bold text-slate-900">Ubah Data Profil</h1>

          <form onsubmit="app.handleSaveProfile(event)" class="space-y-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Nama lengkap</label>
              <input type="text" id="edit-name" class="pb-input text-xs" value="${u.name}" required />
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">No. HP / WhatsApp</label>
              <input type="text" id="edit-phone" class="pb-input text-xs" value="${u.phone}" required />
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
              <input type="email" id="edit-email" class="pb-input text-xs" value="${u.email}" required />
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Alamat penjemputan</label>
              <input type="text" id="edit-address" class="pb-input text-xs" value="${u.address}" required />
            </div>

            <div class="pt-2 flex gap-3">
              <button type="submit" class="pb-btn-primary flex-1 py-3 text-xs">
                Simpan Perubahan
              </button>
              <button type="button" onclick="app.navigateTo('profil')" class="pb-btn-outline flex-1 py-3 text-xs">
                Batal
              </button>
            </div>
          </form>
        </div>
      </div>
    `;
  }

  handleSaveProfile(e) {
    e.preventDefault();
    PB_DATA.user.name = document.getElementById('edit-name').value;
    PB_DATA.user.phone = document.getElementById('edit-phone').value;
    PB_DATA.user.email = document.getElementById('edit-email').value;
    PB_DATA.user.address = document.getElementById('edit-address').value;
    this.showToast('Profil berhasil disimpan!');
    this.navigateTo('profil');
  }

  renderPageUbahSandi() {
    return `
      <div class="max-w-md mx-auto space-y-6">
        <button onclick="app.navigateTo('profil')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Profil
        </button>

        <div class="pb-card p-6 space-y-5">
          <h1 class="text-xl font-bold text-slate-900">Ubah Kata Sandi</h1>

          <form onsubmit="app.handleSavePassword(event)" class="space-y-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Kata sandi lama</label>
              <input type="password" id="old-pass" class="pb-input text-xs" value="password" required />
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Kata sandi baru</label>
              <input type="password" id="new-pass" class="pb-input text-xs" value="rahasia123" required />
              <p class="text-[11px] text-slate-500 mt-1">Kekuatan: Sedang • Minimal 8 karakter</p>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Ulangi kata sandi baru</label>
              <input type="password" id="confirm-pass" class="pb-input text-xs" value="rahasia123" required />
            </div>

            <button type="submit" class="pb-btn-dark w-full py-3">
              Simpan Kata Sandi
            </button>
          </form>
        </div>
      </div>
    `;
  }

  handleSavePassword(e) {
    e.preventDefault();
    this.showToast('Kata sandi berhasil diperbarui!');
    this.navigateTo('profil');
  }

  /* ==========================================================================
     PAGE 12: ADMIN DASHBOARD & MANAGEMENT (FLUID DESKTOP LAYOUT)
     ========================================================================== */
  renderPageAdminBeranda() {
    const s = PB_DATA.adminSummary;
    const pendingDeposits = PB_DATA.deposits.filter(d => d.status === 'Menunggu');

    return `
      <div class="space-y-8">
        
        <!-- Header Greetings -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <p class="text-xs text-slate-500 font-semibold">Panel Administrasi Sistem</p>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Selamat Pagi, Admin 👋</h1>
          </div>
          <button onclick="app.navigateTo('admin-setoran')" class="bg-amber-100 border border-amber-300 text-amber-900 px-4 py-2 rounded-2xl text-xs font-bold flex items-center gap-2 hover:bg-amber-200 transition">
            <span>🔔</span> ${s.pendingVerifications} Setoran Perlu Diverifikasi
          </button>
        </div>

        <!-- 4 Statistic Cards Horizontal across Desktop -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
          <div class="pb-card p-5 space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase">Setoran Menunggu</span>
            <p class="text-2xl sm:text-3xl font-black text-amber-600">${s.pendingVerifications}</p>
            <button onclick="app.navigateTo('admin-setoran')" class="text-xs font-bold text-amber-800 hover:underline pt-1 block">Verifikasi Sekarang →</button>
          </div>

          <div class="pb-card p-5 space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase">Produk Aktif</span>
            <p class="text-2xl sm:text-3xl font-black text-slate-900">${s.activeProducts}</p>
            <span class="text-xs text-slate-500">${s.lowStockProducts} stok menipis</span>
          </div>

          <div class="pb-card p-5 space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase">Workshop Terjadwal</span>
            <p class="text-2xl sm:text-3xl font-black text-slate-900">${s.upcomingWorkshops}</p>
            <button onclick="app.navigateTo('admin-workshop')" class="text-xs font-bold text-emerald-700 hover:underline pt-1 block">Kelola Acara →</button>
          </div>

          <div class="pb-card p-5 space-y-1">
            <span class="text-xs font-semibold text-slate-400 uppercase">Sertifikat Terbit</span>
            <p class="text-2xl sm:text-3xl font-black text-slate-900">${s.publishedCertificates}</p>
            <button onclick="app.navigateTo('admin-sertifikat')" class="text-xs font-bold text-emerald-700 hover:underline pt-1 block">Lihat Sertifikat →</button>
          </div>
        </div>

        <!-- 2 Columns: Verifikasi Setoran Masuk & Ringkasan Pengaturan -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <!-- Left: Setoran Masuk Feed -->
          <div class="lg:col-span-7 pb-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
              <div class="flex items-center gap-2">
                <span class="text-xl">♻️</span>
                <h2 class="font-extrabold text-base text-slate-900">Setoran Masuk Terbaru</h2>
              </div>
              <button onclick="app.navigateTo('admin-setoran')" class="text-xs font-bold text-emerald-700 hover:text-emerald-800">
                Lihat Semua (${s.pendingVerifications}) →
              </button>
            </div>

            <div class="space-y-3">
              ${pendingDeposits.slice(0, 3).map(dep => `
                <div class="p-3.5 bg-slate-50 rounded-2xl flex items-center justify-between gap-3">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white font-bold text-xs flex items-center justify-center text-slate-700 border border-slate-200">
                      ${dep.depositorInit}
                    </div>
                    <div>
                      <h4 class="font-bold text-xs text-slate-900">${dep.depositorName} • ${dep.wasteType}</h4>
                      <p class="text-[11px] text-slate-400">${dep.amount} • ${dep.date} • ${dep.method}</p>
                    </div>
                  </div>

                  <div class="flex items-center gap-2">
                    <button onclick="app.verifyDeposit('${dep.id}', 'Diterima')" class="px-3 py-1.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold">
                      Terima
                    </button>
                    <button onclick="app.verifyDeposit('${dep.id}', 'Ditolak')" class="px-3 py-1.5 rounded-lg bg-slate-200 hover:bg-rose-100 hover:text-rose-700 text-slate-700 text-xs font-bold">
                      Tolak
                    </button>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>

          <!-- Right: Pengaturan Poin & Shortcut -->
          <div class="lg:col-span-5 pb-card p-6 space-y-5">
            <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
              <span class="text-xl">⚙️</span>
              <h2 class="font-extrabold text-base text-slate-900">Konfigurasi Nilai Tukar Poin</h2>
            </div>

            <div class="grid grid-cols-3 text-center py-2 bg-slate-50 rounded-2xl border border-slate-100">
              <div>
                <span class="text-lg font-bold text-slate-900">${s.pointsConfig.multilayerPerKg}</span>
                <span class="text-[10px] text-slate-500 block">Multilayer /kg</span>
              </div>
              <div>
                <span class="text-lg font-bold text-slate-900">${s.pointsConfig.jelantahPerLiter}</span>
                <span class="text-[10px] text-slate-500 block">Jelantah /L</span>
              </div>
              <div>
                <span class="text-lg font-bold text-slate-900">${s.pointsConfig.rankingPeriod}</span>
                <span class="text-[10px] text-slate-500 block">Periode</span>
              </div>
            </div>

            <button onclick="app.navigateTo('admin-poin')" class="pb-btn-dark w-full py-3 text-xs">
              Ubah Parameter Poin & Periode
            </button>
          </div>

        </div>
      </div>
    `;
  }

  renderPageAdminSetoran() {
    const deposits = PB_DATA.deposits.filter(d => {
      if (this.activeDepositFilter === 'Menunggu') return d.status === 'Menunggu';
      if (this.activeDepositFilter === 'Diterima') return d.status === 'Diterima';
      if (this.activeDepositFilter === 'Ditolak') return d.status === 'Ditolak' || d.status === 'Dibatalkan';
      return true;
    });

    const pendingCount = PB_DATA.deposits.filter(d => d.status === 'Menunggu').length;

    return `
      <div class="space-y-6">
        <button onclick="app.navigateTo('admin-beranda')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Dashboard Admin
        </button>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Verifikasi Data Setoran</h1>
            <p class="text-xs text-slate-500 mt-1">Timbang ulang dan verifikasi sampah yang diserahkan penyetor</p>
          </div>

          <!-- Tabs -->
          <div class="flex bg-slate-100 p-1 rounded-2xl text-xs font-semibold">
            <button onclick="app.setDepositFilter('Menunggu')" class="px-4 py-2 rounded-xl transition ${
              this.activeDepositFilter === 'Menunggu' ? 'bg-white shadow-sm text-slate-900 font-bold' : 'text-slate-500'
            }">
              Menunggu (${pendingCount})
            </button>
            <button onclick="app.setDepositFilter('Diterima')" class="px-4 py-2 rounded-xl transition ${
              this.activeDepositFilter === 'Diterima' ? 'bg-white shadow-sm text-slate-900 font-bold' : 'text-slate-500'
            }">
              Diterima
            </button>
            <button onclick="app.setDepositFilter('Ditolak')" class="px-4 py-2 rounded-xl transition ${
              this.activeDepositFilter === 'Ditolak' ? 'bg-white shadow-sm text-slate-900 font-bold' : 'text-slate-500'
            }">
              Ditolak
            </button>
          </div>
        </div>

        <!-- Wide Table on Desktop, Cards on Mobile -->
        <div class="pb-card p-0 overflow-hidden">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-100">
              <tr>
                <th class="py-3.5 px-6">ID & Penyetor</th>
                <th class="py-3.5 px-6">Jenis Sampah</th>
                <th class="py-3.5 px-6">Berat / Vol</th>
                <th class="py-3.5 px-6">Metode</th>
                <th class="py-3.5 px-6">Tanggal</th>
                <th class="py-3.5 px-6">Status</th>
                <th class="py-3.5 px-6 text-right">Tindakan Admin</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              ${deposits.map(dep => `
                <tr class="hover:bg-slate-50 transition">
                  <td class="py-4 px-6">
                    <div class="flex items-center gap-3">
                      <div class="w-8 h-8 rounded-full bg-slate-100 font-bold text-xs flex items-center justify-center text-slate-700">
                        ${dep.depositorInit}
                      </div>
                      <div>
                        <span class="font-bold text-slate-900 block">${dep.depositorName}</span>
                        <span class="text-[11px] text-slate-400">#${dep.id}</span>
                      </div>
                    </div>
                  </td>
                  <td class="py-4 px-6 font-semibold">${dep.wasteType}</td>
                  <td class="py-4 px-6 font-bold text-slate-800">${dep.amount}</td>
                  <td class="py-4 px-6 text-slate-500">${dep.method}</td>
                  <td class="py-4 px-6 text-slate-500">${dep.date}</td>
                  <td class="py-4 px-6">
                    <span class="${dep.status === 'Menunggu' ? 'badge-pending' : dep.status === 'Diterima' ? 'badge-success' : 'badge-danger'}">
                      ${dep.status}
                    </span>
                  </td>
                  <td class="py-4 px-6 text-right">
                    ${dep.status === 'Menunggu' ? `
                      <div class="inline-flex gap-2">
                        <button onclick="app.verifyDeposit('${dep.id}', 'Diterima')" class="px-3.5 py-1.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white font-bold transition">
                          Terima
                        </button>
                        <button onclick="app.verifyDeposit('${dep.id}', 'Ditolak')" class="px-3.5 py-1.5 rounded-lg border border-slate-300 hover:border-rose-300 hover:text-rose-600 font-bold transition">
                          Tolak
                        </button>
                      </div>
                    ` : `
                      <span class="text-slate-400 font-semibold">+${dep.pointsAwarded} Poin</span>
                    `}
                  </td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
      </div>
    `;
  }

  setDepositFilter(filter) {
    this.activeDepositFilter = filter;
    this.render();
  }

  verifyDeposit(depositId, newStatus) {
    const dep = PB_DATA.deposits.find(d => d.id === depositId);
    if (dep) {
      dep.status = newStatus;
      if (newStatus === 'Diterima') {
        dep.steps = [
          { label: 'Setoran dikirim', time: dep.date, done: true },
          { label: 'Diverifikasi admin', time: 'Selesai', done: true },
          { label: 'Diterima', time: 'Sesuai ketentuan', done: true },
          { label: 'Poin masuk', time: `+${dep.pointsAwarded} poin ke akun`, done: true }
        ];
        if (dep.isCurrentUser) {
          PB_DATA.user.totalPoints += dep.pointsAwarded;
          PB_DATA.user.totalKgThisMonth += dep.amountValue;
        }
        this.showToast(`Setoran #${dep.id} diterima! +${dep.pointsAwarded} poin diterbitkan.`);
      } else {
        this.showToast(`Setoran #${dep.id} ditolak.`);
      }
      PB_DATA.adminSummary.pendingVerifications = PB_DATA.deposits.filter(d => d.status === 'Menunggu').length;
    }
    this.render();
  }

  renderPageAdminWorkshop() {
    return `
      <div class="space-y-6">
        <button onclick="app.navigateTo('admin-beranda')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Dashboard Admin
        </button>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <!-- Left: Form Tambah Workshop Baru -->
          <div class="lg:col-span-5 pb-card p-6 space-y-4">
            <h2 class="font-extrabold text-base text-slate-900">Tambah Workshop Baru</h2>

            <form onsubmit="app.handleCreateWorkshop(event)" class="space-y-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul workshop</label>
                <input type="text" id="ws-title" class="pb-input text-xs" placeholder="Mis. Membuat Dompet dari Plastik" required />
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal</label>
                  <input type="text" id="ws-date" class="pb-input text-xs" value="12 Okt 2026" required />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Jam</label>
                  <input type="text" id="ws-time" class="pb-input text-xs" value="09.00" required />
                </div>
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Kuota Kursi</label>
                  <input type="text" id="ws-quota" class="pb-input text-xs" value="20" required />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Biaya</label>
                  <input type="text" id="ws-price" class="pb-input text-xs" value="Gratis" required />
                </div>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea id="ws-desc" rows="3" class="pb-input text-xs" placeholder="Tuliskan tujuan dan materi pelatihan..." required></textarea>
              </div>

              <button type="submit" class="pb-btn-primary w-full py-3">
                Simpan Jadwal Workshop
              </button>
            </form>
          </div>

          <!-- Right: List Workshop Terjadwal -->
          <div class="lg:col-span-7 pb-card p-6 space-y-4">
            <h2 class="font-extrabold text-base text-slate-900">Workshop Terjadwal (${PB_DATA.workshops.length})</h2>

            <div class="divide-y divide-slate-100">
              ${PB_DATA.workshops.map(ws => `
                <div class="py-4 flex items-center justify-between gap-4">
                  <div class="flex items-center gap-3">
                    <span class="text-2xl">${ws.imageIcon}</span>
                    <div>
                      <h4 class="font-bold text-xs sm:text-sm text-slate-900">${ws.title}</h4>
                      <p class="text-xs text-slate-400">${ws.date} • Sisa ${ws.remainingSeats} kursi • ${ws.price}</p>
                    </div>
                  </div>

                  <div class="flex items-center gap-2">
                    <button onclick="app.showToast('Edit workshop simulasi')" class="text-xs font-bold text-slate-600 hover:text-slate-900 px-2 py-1">Edit</button>
                    <button onclick="app.deleteWorkshop('${ws.id}')" class="text-xs font-bold text-rose-600 hover:text-rose-800 px-2 py-1">Hapus</button>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>

        </div>
      </div>
    `;
  }

  handleCreateWorkshop(e) {
    e.preventDefault();
    const title = document.getElementById('ws-title').value;
    const date = document.getElementById('ws-date').value;
    const time = document.getElementById('ws-time').value;
    const quota = parseInt(document.getElementById('ws-quota').value) || 20;
    const price = document.getElementById('ws-price').value;
    const desc = document.getElementById('ws-desc').value;

    const newWs = {
      id: `ws-${Date.now()}`,
      title: title,
      series: 'Workshop Offline Project B',
      date: date,
      time: time,
      quota: quota,
      remainingSeats: quota,
      seatsBooked: 0,
      price: price,
      instructor: 'Instruktur Project B',
      imageIcon: '🧵',
      description: desc,
      syllabus: ['Pengenalan materi daur ulang', 'Praktik pembuatan pola', 'Finishing jahitan'],
      targetAudience: 'Masyarakat umum dan komunitas.'
    };

    PB_DATA.workshops.unshift(newWs);
    PB_DATA.adminSummary.upcomingWorkshops++;
    this.showToast('Workshop baru berhasil disimpan!');
    this.render();
  }

  deleteWorkshop(id) {
    PB_DATA.workshops = PB_DATA.workshops.filter(w => w.id !== id);
    this.showToast('Workshop berhasil dihapus.');
    this.render();
  }

  renderPageAdminSertifikat() {
    return `
      <div class="space-y-6">
        <button onclick="app.navigateTo('admin-beranda')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Dashboard Admin
        </button>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          
          <div class="lg:col-span-5 pb-card p-6 space-y-4">
            <h2 class="font-extrabold text-base text-slate-900">Tambah Sertifikat / Dokumen Legalitas</h2>

            <form onsubmit="app.handleCreateCertificate(event)" class="space-y-4">
              <div class="border-2 border-dashed border-slate-300 rounded-2xl p-5 text-center cursor-pointer hover:bg-slate-50" onclick="app.showToast('File dokumen terpilih!')">
                <span class="text-3xl text-slate-400">📄</span>
                <p class="text-xs text-slate-600 mt-1 font-semibold">Ketuk untuk unggah dokumen (JPG/PNG/PDF)</p>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Sertifikat</label>
                <input type="text" id="cert-title" class="pb-input text-xs" placeholder="Mis. UMKM Hijau Terbaik" required />
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Penyelenggara</label>
                  <input type="text" id="cert-issuer" class="pb-input text-xs" placeholder="Dinas Lingkungan Hidup" required />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Tahun</label>
                  <input type="text" id="cert-year" class="pb-input text-xs" value="2026" required />
                </div>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Penjelasan</label>
                <textarea id="cert-desc" rows="3" class="pb-input text-xs" placeholder="Jelaskan dasar penilaian dan dampak penghargaan..." required></textarea>
              </div>

              <button type="submit" class="pb-btn-dark w-full py-3">
                Simpan Dokumen
              </button>
            </form>
          </div>

          <div class="lg:col-span-7 pb-card p-6 space-y-4">
            <h2 class="font-extrabold text-base text-slate-900">Daftar Sertifikat Terbit</h2>
            <div class="divide-y divide-slate-100">
              ${PB_DATA.certificates.map(c => `
                <div class="py-3.5 flex items-center justify-between">
                  <div>
                    <h4 class="font-bold text-xs text-slate-900">${c.title}</h4>
                    <p class="text-[11px] text-slate-400">${c.issuer} · ${c.year} · ${c.type}</p>
                  </div>
                  <button onclick="app.navigateTo('detail-sertifikat', PB_DATA.certificates.find(item => item.id === '${c.id}'))" class="text-xs font-bold text-emerald-700 hover:text-emerald-800">
                    Buka Dokumen ›
                  </button>
                </div>
              `).join('')}
            </div>
          </div>

        </div>
      </div>
    `;
  }

  handleCreateCertificate(e) {
    e.preventDefault();
    const title = document.getElementById('cert-title').value;
    const issuer = document.getElementById('cert-issuer').value;
    const year = document.getElementById('cert-year').value;
    const desc = document.getElementById('cert-desc').value;

    const newCert = {
      id: `cert-${Date.now()}`,
      title: title,
      issuer: issuer,
      year: year,
      type: 'Penghargaan',
      icon: '🏆',
      description: desc,
      latestInfo: 'Berlaku aktif'
    };

    PB_DATA.certificates.unshift(newCert);
    PB_DATA.adminSummary.publishedCertificates++;
    this.showToast('Sertifikat berhasil ditambahkan!');
    this.render();
  }

  renderPageAdminPoin() {
    const p = PB_DATA.adminSummary.pointsConfig;
    return `
      <div class="max-w-xl mx-auto space-y-6">
        <button onclick="app.navigateTo('admin-beranda')" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
          ← Kembali ke Dashboard Admin
        </button>

        <div class="pb-card p-6 sm:p-8 space-y-6">
          <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Pengaturan Nilai Tukar Poin</h1>
            <p class="text-xs text-slate-500 mt-1">Sesuaikan konversi poin per satuan berat serta periode reset leaderboard</p>
          </div>

          <form onsubmit="app.handleSavePointsConfig(event)" class="space-y-5">
            <div class="space-y-3">
              <h3 class="font-bold text-xs text-slate-700 uppercase">Poin Per Satuan</h3>
              
              <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold text-slate-900">Kemasan Multilayer (per kg)</span>
                <input type="number" id="cfg-multilayer" class="w-20 text-center font-bold pb-input py-2 text-xs" value="${p.multilayerPerKg}" required />
              </div>

              <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
                <span class="text-xs font-bold text-slate-900">Minyak Jelantah (per Liter)</span>
                <input type="number" id="cfg-jelantah" class="w-20 text-center font-bold pb-input py-2 text-xs" value="${p.jelantahPerLiter}" required />
              </div>
            </div>

            <div class="space-y-2">
              <label class="block text-xs font-bold text-slate-700 uppercase">Periode Peringkat</label>
              <div class="grid grid-cols-3 gap-2" id="period-chips">
                <button type="button" onclick="app.selectRankingPeriod('Mingguan', this)" class="py-2.5 rounded-xl text-xs font-semibold border ${
                  p.rankingPeriod === 'Mingguan' ? 'border-slate-800 bg-slate-900 text-white' : 'border-slate-300 bg-white text-slate-700'
                }">Mingguan</button>
                <button type="button" onclick="app.selectRankingPeriod('Bulanan', this)" class="py-2.5 rounded-xl text-xs font-semibold border ${
                  p.rankingPeriod === 'Bulanan' ? 'border-slate-800 bg-slate-900 text-white' : 'border-slate-300 bg-white text-slate-700'
                }">Bulanan</button>
                <button type="button" onclick="app.selectRankingPeriod('Kuartal', this)" class="py-2.5 rounded-xl text-xs font-semibold border ${
                  p.rankingPeriod === 'Kuartal' ? 'border-slate-800 bg-slate-900 text-white' : 'border-slate-300 bg-white text-slate-700'
                }">Kuartal</button>
              </div>
            </div>

            <button type="submit" class="pb-btn-primary w-full py-3.5">
              Simpan Konfigurasi
            </button>
          </form>
        </div>
      </div>
    `;
  }

  selectRankingPeriod(period, btn) {
    PB_DATA.adminSummary.pointsConfig.rankingPeriod = period;
    btn.parentElement.querySelectorAll('button').forEach(b => {
      b.className = 'py-2.5 rounded-xl text-xs font-semibold border border-slate-300 bg-white text-slate-700';
    });
    btn.className = 'py-2.5 rounded-xl text-xs font-semibold border border-slate-800 bg-slate-900 text-white';
  }

  handleSavePointsConfig(e) {
    e.preventDefault();
    PB_DATA.adminSummary.pointsConfig.multilayerPerKg = parseInt(document.getElementById('cfg-multilayer').value);
    PB_DATA.adminSummary.pointsConfig.jelantahPerLiter = parseInt(document.getElementById('cfg-jelantah').value);
    this.showToast('Pengaturan poin berhasil diperbarui!');
    this.navigateTo('admin-beranda');
  }
}

// Global App Instance
window.app = new ProjectBApp();
