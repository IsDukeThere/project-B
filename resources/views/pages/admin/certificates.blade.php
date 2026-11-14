@extends('layouts.admin')

@section('title', 'Kelola Sertifikat')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <div class="lg:col-span-5 pb-card p-6 space-y-4 bg-white">
            <h2 class="font-extrabold text-base text-slate-900">{{ isset($editCertificate) ? 'Edit Sertifikat / Penghargaan' : 'Tambah Sertifikat / Penghargaan' }}</h2>

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

            <form action="{{ isset($editCertificate) ? route('admin.certificates.update', $editCertificate->id) : route('admin.certificates.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf
                @if(isset($editCertificate))
                    @method('PUT')
                @endif

                <div class="relative overflow-hidden border-2 border-dashed border-slate-300 rounded-2xl p-5 text-center cursor-pointer hover:bg-slate-50 min-h-[140px] flex flex-col justify-center items-center">
                    <input type="file" id="imageInput" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">

                    <div id="defaultState" class="z-10 pointer-events-none {{ isset($editCertificate) && $editCertificate->image ? 'hidden' : '' }}">
                        <span class="text-3xl text-slate-400 block mb-1">📄</span>
                        <p class="text-xs text-slate-600 mt-1 font-semibold">Ketuk untuk unggah dokumen (JPG/PNG)</p>
                        <p class="text-[10px] text-slate-400">(Maksimal 5 MB)</p>
                    </div>

                    <img id="imagePreview"
                         src="{{ isset($editCertificate) && $editCertificate->image ? asset($editCertificate->image) : '' }}"
                         class="{{ isset($editCertificate) && $editCertificate->image ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover z-10 pointer-events-none"
                         alt="Preview Sertifikat">
                </div>
                @if(isset($editCertificate))
                    <p class="text-[11px] text-slate-400 -mt-2">Biarkan gambar jika tidak ingin mengganti dokumen lama.</p>
                @endif
                @error('image')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Sertifikat</label>
                    <input type="text" class="pb-input text-xs" value="{{ old('nama', $editCertificate->nama ?? '') }}" placeholder="Mis. UMKM Hijau Terbaik" name="nama" required />
                    @error('nama')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Penyelenggara</label>
                        <input type="text" class="pb-input text-xs" value="{{ old('penyelenggara', $editCertificate->penyelenggara ?? '') }}" placeholder="Dinas Lingkungan Hidup" name="penyelenggara" required />
                        @error('penyelenggara')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tahun</label>
                        <input type="text" class="pb-input text-xs" value="{{ old('tahun', $editCertificate->tahun ?? '2026') }}" name="tahun" required />
                        @error('tahun')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Penjelasan</label>
                    <textarea rows="3" class="pb-input text-xs" placeholder="Jelaskan dasar penilaian, manfaat, dan arti penghargaan ini..." name="penjelasan" required>{{ old('penjelasan', $editCertificate->penjelasan ?? '') }}</textarea>
                    @error('penjelasan')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <button type="submit" class="pb-btn-dark w-full py-3">
                        {{ isset($editCertificate) ? 'Simpan Perubahan' : 'Simpan Sertifikat' }}
                    </button>

                    @if(isset($editCertificate))
                        <a href="{{ route('admin.certificates.create') }}" class="px-4 py-3 rounded-full border border-slate-300 text-xs font-bold text-slate-600 hover:bg-slate-100 transition text-center">
                            Batal
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Daftar Sertifikat Terbit -->
        <div class="lg:col-span-7 pb-card p-6 space-y-4 bg-white rounded-2xl shadow-sm border border-slate-100">
            <h2 class="font-extrabold text-base text-slate-900">
                Daftar Sertifikat Terbit ({{ $certificates->count() }})
            </h2>

            <div class="divide-y divide-slate-100">
                @forelse($certificates as $certificate)
                    <div class="py-3.5 px-2 rounded-xl flex items-center justify-between {{ isset($editCertificate) && $editCertificate->id === $certificate->id ? 'bg-amber-50/70' : '' }}">
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">{{ $certificate->nama }}</h4>
                            <p class="text-[11px] text-slate-400">
                                {{ $certificate->penyelenggara }} &bull; {{ $certificate->tahun }} &bull; Penghargaan
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <form action="{{ route('admin.certificates.destroy', $certificate->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700 transition">
                                    Hapus
                                </button>
                            </form>

                            <a href="{{ route('admin.certificates.edit', $certificate->id) }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 transition">
                                Edit ›
                            </a>
                        </div>
                    </div>

                @empty
                    <div class="text-center py-10">
                        <span class="text-4xl block mb-2">📜</span>
                        <p class="text-sm text-slate-500 font-medium">Belum ada sertifikat yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            // Cek apakah file adalah gambar
            if (file.type.match('image.*')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Sembunyikan ikon & teks default
                    document.getElementById('defaultState').classList.add('hidden');

                    // Munculkan tag img dan isi source-nya dengan file yang dipilih
                    const imgPreview = document.getElementById('imagePreview');
                    imgPreview.src = e.target.result;
                    imgPreview.classList.remove('hidden');

                    // Munculkan overlay "Ganti Gambar"
                    document.getElementById('hoverOverlay').classList.remove('hidden');
                }

                // Baca file sebagai Data URL biar bisa ditampilin
                reader.readAsDataURL(file);
            }
        }
    });
</script>
@endsection
