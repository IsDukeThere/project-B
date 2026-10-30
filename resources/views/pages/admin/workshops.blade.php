@extends('layouts.admin')

@section('title', 'Kelola Workshop')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <div class="lg:col-span-5 pb-card p-6 space-y-4 bg-white">
            <h2 class="font-extrabold text-base text-slate-900">Tambah Workshop Baru</h2>

            <!-- 1. Notifikasi Sukses -->
            @if(session('success'))
                <div class="mt-4 p-4 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl font-medium text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 2. Notifikasi Error General -->
            @if($errors->any())
                <div class="mt-4 p-4 bg-red-50 text-red-700 border border-red-200 rounded-xl text-sm">
                    <strong class="font-bold">Gagal menyimpan!</strong> Tolong cek kembali isian form Anda.
                </div>
            @endif

            <form action="{{ route('admin.workshops.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Gambar Cover -->
                <div class="mb-4 w-full">
                    <!-- Area Dropzone / Klik -->
                    <label for="image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 relative overflow-hidden transition-all">

                        <!-- Konten Ikon & Teks (Akan disembunyikan saat gambar dipilih) -->
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 dropzone-content">
                            <!-- Ikon Dokumen Warna Ungu Muda -->
                            <svg class="w-12 h-12 mb-3 text-purple-200" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v6h6v10H6zm2-3h8v2H8v-2zm0-4h8v2H8v-2z"></path>
                            </svg>
                            <p class="mb-1 text-sm font-medium text-slate-700">Ketuk untuk unggah dokumen (JPG/PNG)</p>
                            <p class="text-sm text-slate-400">(Maksimal 5 MB)</p>
                        </div>

                        <!-- Tempat Preview Gambar (Awalnya disembunyikan dengan class 'hidden') -->
                        <img class="img-preview absolute inset-0 w-full h-full object-cover hidden" alt="Preview Cover">

                        <!-- Input File Asli (Disembunyikan dari layar tapi tetap berfungsi) -->
                        <input id="image" type="file" name="cover_image" class="hidden" accept="image/jpeg, image/png" onchange="previewImage()" />
                    </label>
                </div>

                <!-- Judul -->
                <div class="mt-4">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Judul workshop</label>
                    <!-- Tambah name="judul" dan value old() -->
                    <input type="text" name="judul" value="{{ old('judul') }}" class="pb-input text-xs" placeholder="Mis. Membuat Dompet dari Plastik" required />
                    @error('judul')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3 mt-4">
                    <!-- Tanggal -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal</label>
                        <!-- Diubah jadi type="date" biar muncul kalender -->
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="pb-input text-xs" required />
                        @error('tanggal')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Jam -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jam</label>
                        <!-- Diubah jadi type="time" biar gampang pilih jam -->
                        <input type="time" name="jam" value="{{ old('jam') }}" class="pb-input text-xs" required />
                        @error('jam')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-4">
                    <!-- Kuota Kursi -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kuota Kursi</label>
                        <input type="text" name="kuota" value="{{ old('kuota') }}" placeholder="Mis: 20 kursi" class="pb-input text-xs" required />
                        @error('kuota')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Biaya -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Biaya</label>
                        <input type="text" name="biaya" value="{{ old('biaya') }}" placeholder="Mis: Gratis / Rp 50.000" class="pb-input text-xs" required />
                        @error('biaya')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-4">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <!-- Textarea menaruh old() di tengah tag, bukan di dalam value -->
                    <textarea name="deskripsi" rows="3" class="pb-input text-xs" placeholder="Tulis deskripsi singkat…" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link Pendaftaran -->
                <div class="mt-4 mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Link Pendaftaran</label>
                    <input type="url" name="registration_link" value="{{ old('registration_link') }}" class="w-full px-3 py-2 border rounded-lg focus:ring-emerald-500" placeholder="Mis: https://forms.gle/..." required>
                    @error('registration_link')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="pb-btn-primary w-full py-3">
                    Simpan Workshop
                </button>
            </form>
        </div>

        <div class="lg:col-span-7 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <h2 class="font-bold text-lg text-slate-900 mb-5">
                Workshop Terjadwal ({{ $workshops->count() }})
            </h2>
            
            <div class="space-y-4">
                @forelse($workshops as $ws)
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4 last:border-0 last:pb-0">
                        
                        <!-- Info Kiri (Ikon + Judul) -->
                        <div class="flex items-center gap-4">
                            <!-- Ikon/Gambar Kecil -->
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-xl overflow-hidden shrink-0">
                                @if($ws->image && file_exists(public_path($ws->image)))
                                    <img src="{{ asset($ws->image) }}" alt="" class="w-full h-full object-cover">
                                @else
                                    🎓
                                @endif
                            </div>
                            
                            <!-- Detail Teks -->
                            <div>
                                <h3 class="font-bold text-sm text-slate-900">{{ $ws->judul }}</h3>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    <!-- Format tanggal contoh: 12 Okt -->
                                    {{ \Carbon\Carbon::parse($ws->tanggal)->translatedFormat('d M') }} &bull; {{ $ws->jam }} &bull; Sisa {{ $ws->kuota }}
                                </p>
                            </div>
                        </div>

                        <!-- Tombol Aksi Kanan (Edit & Hapus) -->
                        <div class="flex items-center gap-4 text-xs font-semibold shrink-0">
                            <a href="#" class="text-slate-600 hover:text-emerald-700 transition">Edit</a>
                            
                            <!-- Form Hapus -->
                            <form action="{{ route('admin.workshops.destroy', $ws->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus workshop ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition">Hapus</button>
                            </form>
                        </div>

                    </div>
                @empty
                    <!-- Tampilan jika belum ada data sama sekali -->
                    <div class="text-center py-6">
                        <p class="text-sm text-slate-500">Belum ada workshop yang dijadwalkan.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        const dropzoneContent = document.querySelector('.dropzone-content');

        if(image.files.length > 0) {
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
                imgPreview.classList.remove('hidden');

                dropzoneContent.classList.add('hidden');
            }
        }
    }
</script>
@endsection
