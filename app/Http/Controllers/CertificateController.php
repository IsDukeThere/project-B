<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class CertificateController extends Controller
{
    // ================= BAGIAN ADMIN =================

    // 1. Tampil form & daftar di Admin
    public function create()
    {
        $certificates = Certificate::latest()->get();
        return view('pages.admin.certificates', compact('certificates'));
    }

    // 2. Simpan data dari Admin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'tahun' => 'required|string|max:4',
            'penjelasan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Maksimal 5MB
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img/certificates'), $imageName);
            $validated['image'] = 'img/certificates/' . $imageName;
        }

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '_' . $image->getClientOriginalName();

        //     $publicDir = public_path('img/certificates');
        //     $storageDir = storage_path('app/public/certificates');

        //     if (!file_exists($storageDir)) {
        //         mkdir($storageDir, 0755, true);
        //     }

        //     if (!is_link($publicDir)) {
        //         if (is_dir($publicDir)) {
        //             @rmdir($publicDir);
        //         }
        //         @symlink($storageDir, $publicDir);
        //     }

        //     $image->move($publicDir, $imageName);
        //     $validated['image'] = 'img/certificates/' . $imageName;
        // }

        Certificate::create($validated);
        return redirect()->back()->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    // 3. Hapus data di Admin
    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        if ($certificate->image && file_exists(public_path($certificate->image))) {
            unlink(public_path($certificate->image));
        }
        $certificate->delete();
        return redirect()->back()->with('success', 'Sertifikat berhasil dihapus!');
    }


    // ================= BAGIAN USER =================

    // 4. Tampil daftar semua sertifikat di User
    public function index()
    {
        $certificates = Certificate::latest()->get();
        $originHub = $this->getOriginHub();
        $dataSebaran = $this->getSebaranData();
        $internasional = $this->getInternasionalData();

        $totalSebaran = 2952;
        $topRegion = collect($dataSebaran)->sortByDesc('jumlah')->first();

        return view('pages.certificates.index', compact(
            'certificates',
            'originHub',
            'dataSebaran',
            'internasional',
            'totalSebaran',
            'topRegion'
        ));
    }

    public function apiData()
    {
        return response()->json([
            'status' => 'success',
            'total_sebaran' => 2952,
            'origin_hub' => $this->getOriginHub(),
            'sebaran_wilayah' => $this->getSebaranData(),
            'internasional' => $this->getInternasionalData(),
        ]);
    }

    private function getOriginHub(): array
    {
        return [
            'kode' => 'yogyakarta',
            'nama' => 'D.I. Yogyakarta (Pusat Distribusi)',
            'kota' => 'Yogyakarta (Jogja)',
            'jumlah' => 259,
            'x' => 465,
            'y' => 512,
            'warna_utama' => '#10b981', // Emerald Green
            'warna_sekunder' => '#0ea5e9', // Electric Blue
            'deskripsi' => 'Pusat Rumah Produksi & Distribusi Butik Daur Ulang Project B Indonesia',
        ];
    }


     private function getSebaranData(): array
    {
        return [
            // Kolom 1 (sesuai tabel gambar)
            ['no' => 1,  'kode' => 'aceh',       'nama' => 'Aceh',         'jumlah' => 46,  'alur' => 'hijau', 'pulau' => 'Sumatera', 'x' => 75,  'y' => 155],
            ['no' => 2,  'kode' => 'riau',       'nama' => 'Riau',         'jumlah' => 89,  'alur' => 'hijau', 'pulau' => 'Sumatera', 'x' => 200, 'y' => 265],
            ['no' => 3,  'kode' => 'kepri',      'nama' => 'Kepri',        'jumlah' => 27,  'alur' => 'hijau', 'pulau' => 'Sumatera', 'x' => 255, 'y' => 255],
            ['no' => 4,  'kode' => 'jambi',      'nama' => 'Jambi',        'jumlah' => 46,  'alur' => 'hijau', 'pulau' => 'Sumatera', 'x' => 220, 'y' => 335],
            ['no' => 5,  'kode' => 'sumut',      'nama' => 'Sumut',        'jumlah' => 41,  'alur' => 'hijau', 'pulau' => 'Sumatera', 'x' => 120, 'y' => 195],

            // Kolom 2
            ['no' => 6,  'kode' => 'sumsel',     'nama' => 'Sumsel',       'jumlah' => 44,  'alur' => 'hijau', 'pulau' => 'Sumatera', 'x' => 250, 'y' => 385],
            ['no' => 7,  'kode' => 'sumbar',     'nama' => 'Sumbar',       'jumlah' => 24,  'alur' => 'hijau', 'pulau' => 'Sumatera', 'x' => 155, 'y' => 320],
            ['no' => 8,  'kode' => 'lampung',    'nama' => 'Lampung',      'jumlah' => 44,  'alur' => 'hijau', 'pulau' => 'Sumatera', 'x' => 275, 'y' => 435],
            ['no' => 9,  'kode' => 'jakarta',    'nama' => 'Jakarta',      'jumlah' => 391, 'jumlah_map' => 393, 'alur' => 'hijau', 'pulau' => 'Jawa', 'x' => 345, 'y' => 465],
            ['no' => 10, 'kode' => 'banten',     'nama' => 'Banten',       'jumlah' => 181, 'alur' => 'hijau', 'pulau' => 'Jawa',     'x' => 310, 'y' => 465],

            // Kolom 3
            ['no' => 11, 'kode' => 'jateng',     'nama' => 'Jateng',       'jumlah' => 591, 'alur' => 'hijau', 'pulau' => 'Jawa',     'x' => 440, 'y' => 485],
            ['no' => 12, 'kode' => 'jabar',      'nama' => 'Jawa Barat',   'jumlah' => 490, 'alur' => 'hijau', 'pulau' => 'Jawa',     'x' => 375, 'y' => 485],
            ['no' => 13, 'kode' => 'jatim',      'nama' => 'Jawa Timur',   'jumlah' => 365, 'alur' => 'biru',  'pulau' => 'Jawa',     'x' => 520, 'y' => 495],
            ['no' => 14, 'kode' => 'yogyakarta', 'nama' => 'Yogyakarta',   'jumlah' => 259, 'alur' => 'origin', 'pulau' => 'Jawa (Pusat)', 'x' => 465, 'y' => 512, 'is_origin' => true],
            ['no' => 15, 'kode' => 'kaltra',     'nama' => 'Kaltra',       'jumlah' => 11,  'alur' => 'hijau', 'pulau' => 'Kalimantan', 'x' => 575, 'y' => 220],

            // Kolom 4
            ['no' => 16, 'kode' => 'kalbar',     'nama' => 'Kalbar',       'jumlah' => 33,  'alur' => 'hijau', 'pulau' => 'Kalimantan', 'x' => 405, 'y' => 320],
            ['no' => 17, 'kode' => 'kaltim',     'nama' => 'Kaltim',       'jumlah' => 65,  'alur' => 'hijau', 'pulau' => 'Kalimantan', 'x' => 565, 'y' => 310],
            ['no' => 18, 'kode' => 'kalsel',     'nama' => 'Kalsel',       'jumlah' => 46,  'alur' => 'hijau', 'pulau' => 'Kalimantan', 'x' => 525, 'y' => 375],
            ['no' => 19, 'kode' => 'sulut',      'nama' => 'Sulut',        'jumlah' => 33,  'alur' => 'biru',  'pulau' => 'Sulawesi',   'x' => 760, 'y' => 245],
            ['no' => 20, 'kode' => 'sulteng',    'nama' => 'Sulteng',      'jumlah' => 10,  'alur' => 'biru',  'pulau' => 'Sulawesi',   'x' => 675, 'y' => 315],

            // Kolom 5
            ['no' => 21, 'kode' => 'sulbar',     'nama' => 'Sulbar',       'jumlah' => 8,   'alur' => 'biru',  'pulau' => 'Sulawesi',   'x' => 645, 'y' => 365],
            ['no' => 22, 'kode' => 'sulsel',     'nama' => 'Sulsel',       'jumlah' => 53,  'alur' => 'biru',  'pulau' => 'Sulawesi',   'x' => 655, 'y' => 430],
            ['no' => 23, 'kode' => 'bali',       'nama' => 'Bali',         'jumlah' => 53,  'alur' => 'biru',  'pulau' => 'Bali & NT',  'x' => 575, 'y' => 510],
            ['no' => 24, 'kode' => 'ntb',        'nama' => 'NTB',          'jumlah' => 36,  'alur' => 'biru',  'pulau' => 'Bali & NT',  'x' => 625, 'y' => 515],
            ['no' => 25, 'kode' => 'ntt',        'nama' => 'NTT',          'jumlah' => 10,  'alur' => 'biru',  'pulau' => 'Bali & NT',  'x' => 725, 'y' => 530],

            // Kolom 6
            ['no' => 26, 'kode' => 'maluku',     'nama' => 'Maluku',       'jumlah' => 4,   'alur' => 'biru',  'pulau' => 'Maluku & Papua', 'x' => 885,  'y' => 385],
            ['no' => 27, 'kode' => 'papua',      'nama' => 'Papua',        'jumlah' => 3,   'alur' => 'biru',  'pulau' => 'Maluku & Papua', 'x' => 1090, 'y' => 390],
        ];
    }
    /**
     * Jangkauan ekspor internasional sesuai gambar (5 Negara).
     */
    private function getInternasionalData(): array
    {
        return [
            ['negara' => 'Amerika',  'kode' => 'USA', 'alur' => 'biru', 'x' => 105, 'y' => 80],
            ['negara' => 'Jerman',   'kode' => 'DEU', 'alur' => 'biru', 'x' => 245, 'y' => 105],
            ['negara' => 'Taiwan',   'kode' => 'TWN', 'alur' => 'biru', 'x' => 460, 'y' => 115],
            ['negara' => 'Jepang',   'kode' => 'JPN', 'alur' => 'biru', 'x' => 670, 'y' => 90],
            ['negara' => 'Filipina', 'kode' => 'PHL', 'alur' => 'biru', 'x' => 745, 'y' => 175],
        ];
    }

    // 5. Tampil halaman detail sertifikat di User
    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('pages.certificates.show', compact('certificate'));
    }
}
