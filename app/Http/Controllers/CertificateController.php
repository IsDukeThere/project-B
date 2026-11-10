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

        $dataSebaran = $this->getSebaranData();
        $internasional = $this->getInternasionalData();
        $hubs = $this->getHubsData();

        $totalSebaran = array_sum(array_column($dataSebaran, 'jumlah'));
        $topRegion = collect($dataSebaran)->sortByDesc('jumlah')->first();

        // 3. KIRIM SEMUA DATANYA KE VIEW
        return view('pages.certificates.index', compact(
            'certificates',
            'dataSebaran',
            'internasional',
            'hubs',
            'totalSebaran',
            'topRegion'
        ));
    }

     private function getSebaranData(): array
    {
        return [
            ['no' => 1,  'kode' => 'aceh',       'nama' => 'Aceh',         'jumlah' => 46,  'hub' => 'jakarta', 'pulau' => 'Sumatera', 'x' => 75,  'y' => 155],
            ['no' => 2,  'kode' => 'riau',       'nama' => 'Riau',         'jumlah' => 89,  'hub' => 'jakarta', 'pulau' => 'Sumatera', 'x' => 200, 'y' => 265],
            ['no' => 3,  'kode' => 'kepri',      'nama' => 'Kepri',        'jumlah' => 27,  'hub' => 'jakarta', 'pulau' => 'Sumatera', 'x' => 255, 'y' => 255],
            ['no' => 4,  'kode' => 'jambi',      'nama' => 'Jambi',        'jumlah' => 46,  'hub' => 'jakarta', 'pulau' => 'Sumatera', 'x' => 220, 'y' => 335],
            ['no' => 5,  'kode' => 'sumut',      'nama' => 'Sumut',        'jumlah' => 41,  'hub' => 'jakarta', 'pulau' => 'Sumatera', 'x' => 120, 'y' => 195],
            ['no' => 6,  'kode' => 'sumsel',     'nama' => 'Sumsel',       'jumlah' => 44,  'hub' => 'jakarta', 'pulau' => 'Sumatera', 'x' => 250, 'y' => 385],
            ['no' => 7,  'kode' => 'sumbar',     'nama' => 'Sumbar',       'jumlah' => 24,  'hub' => 'jakarta', 'pulau' => 'Sumatera', 'x' => 155, 'y' => 320],
            ['no' => 8,  'kode' => 'lampung',    'nama' => 'Lampung',      'jumlah' => 44,  'hub' => 'jakarta', 'pulau' => 'Sumatera', 'x' => 275, 'y' => 435],

            ['no' => 9,  'kode' => 'jakarta',    'nama' => 'DKI Jakarta',  'jumlah' => 393, 'hub' => 'jakarta', 'pulau' => 'Jawa',     'x' => 345, 'y' => 465, 'is_hub' => true, 'hub_type' => 'sub'],
            ['no' => 10, 'kode' => 'banten',     'nama' => 'Banten',       'jumlah' => 181, 'hub' => 'jakarta', 'pulau' => 'Jawa',     'x' => 310, 'y' => 465],
            ['no' => 12, 'kode' => 'jabar',      'nama' => 'Jawa Barat',   'jumlah' => 490, 'hub' => 'jakarta', 'pulau' => 'Jawa',     'x' => 375, 'y' => 485],

            ['no' => 15, 'kode' => 'kaltra',     'nama' => 'Kaltra',       'jumlah' => 11,  'hub' => 'jakarta', 'pulau' => 'Kalimantan', 'x' => 575, 'y' => 220],
            ['no' => 16, 'kode' => 'kalbar',     'nama' => 'Kalbar',       'jumlah' => 33,  'hub' => 'jakarta', 'pulau' => 'Kalimantan', 'x' => 405, 'y' => 320],
            ['no' => 17, 'kode' => 'kaltim',     'nama' => 'Kaltim',       'jumlah' => 65,  'hub' => 'jakarta', 'pulau' => 'Kalimantan', 'x' => 565, 'y' => 310],
            ['no' => 18, 'kode' => 'kalsel',     'nama' => 'Kalsel',       'jumlah' => 46,  'hub' => 'jakarta', 'pulau' => 'Kalimantan', 'x' => 525, 'y' => 375],

            ['no' => 11, 'kode' => 'jateng',     'nama' => 'Jawa Tengah',  'jumlah' => 591, 'hub' => 'yogyakarta', 'pulau' => 'Jawa', 'x' => 440, 'y' => 485],
            ['no' => 13, 'kode' => 'jatim',      'nama' => 'Jawa Timur',   'jumlah' => 365, 'hub' => 'yogyakarta', 'pulau' => 'Jawa', 'x' => 520, 'y' => 495],
            ['no' => 14, 'kode' => 'yogyakarta', 'nama' => 'Yogyakarta',   'jumlah' => 259, 'hub' => 'yogyakarta', 'pulau' => 'Jawa', 'x' => 450, 'y' => 510, 'is_hub' => true, 'hub_type' => 'main'],

            ['no' => 19, 'kode' => 'sulut',      'nama' => 'Sulut',        'jumlah' => 33,  'hub' => 'yogyakarta', 'pulau' => 'Sulawesi', 'x' => 760, 'y' => 245],
            ['no' => 20, 'kode' => 'sulteng',    'nama' => 'Sulteng',      'jumlah' => 10,  'hub' => 'yogyakarta', 'pulau' => 'Sulawesi', 'x' => 675, 'y' => 315],
            ['no' => 21, 'kode' => 'sulbar',     'nama' => 'Sulbar',       'jumlah' => 8,   'hub' => 'yogyakarta', 'pulau' => 'Sulawesi', 'x' => 645, 'y' => 365],
            ['no' => 22, 'kode' => 'sulsel',     'nama' => 'Sulsel',       'jumlah' => 53,  'hub' => 'yogyakarta', 'pulau' => 'Sulawesi', 'x' => 655, 'y' => 430],

            ['no' => 23, 'kode' => 'bali',       'nama' => 'Bali',         'jumlah' => 53,  'hub' => 'yogyakarta', 'pulau' => 'Bali & Nusa Tenggara', 'x' => 575, 'y' => 510],
            ['no' => 24, 'kode' => 'ntb',        'nama' => 'NTB',          'jumlah' => 36,  'hub' => 'yogyakarta', 'pulau' => 'Bali & Nusa Tenggara', 'x' => 625, 'y' => 515],
            ['no' => 25, 'kode' => 'ntt',        'nama' => 'NTT',          'jumlah' => 10,  'hub' => 'yogyakarta', 'pulau' => 'Bali & Nusa Tenggara', 'x' => 725, 'y' => 530],

            // Maluku & Papua
            ['no' => 26, 'kode' => 'maluku',     'nama' => 'Maluku',       'jumlah' => 4,   'hub' => 'yogyakarta', 'pulau' => 'Maluku & Papua', 'x' => 885,  'y' => 385],
            ['no' => 27, 'kode' => 'papua',      'nama' => 'Papua',        'jumlah' => 3,   'hub' => 'yogyakarta', 'pulau' => 'Maluku & Papua', 'x' => 1090, 'y' => 390],
        ];
    }

    /**
     * Hub utama dan sub-hub distribusi.
     */
    private function getHubsData(): array
    {
        return [
            'jakarta' => [
                'nama' => 'Regional Sub-Hub (Jakarta)',
                'lokasi' => 'DKI Jakarta',
                'warna' => '#0ea5e9', // Hijau Zamrud
                'tipe' => 'sub',
                'deskripsi' => 'Pusat distribusi mencakup Sumatera, Banten, Jawa Barat, dan Kalimantan',
                'x' => 345,
                'y' => 465,
            ],

            'yogyakarta' => [
                'nama' => 'Main Distribution Hub (Yogyakarta)',
                'lokasi' => 'Yogyakarta',
                'warna' => '#10b981', // Biru Safir
                'tipe' => 'main',
                'deskripsi' => 'Pusat distribusi utama mencakup Jawa Tengah, Timur, Bali, Nusa Tenggara, Sulawesi, Maluku, dan Papua',
                'x' => 450,
                'y' => 510,
            ],
        ];
    }

    /**
     * Jangkauan ekspor internasional sesuai gambar (5 Negara).
     */
    private function getInternasionalData(): array
    {
        return [
            ['negara' => 'Amerika',  'kode' => 'USA', 'hub' => 'jakarta',  'x' => 105, 'y' => 80],
            ['negara' => 'Jerman',   'kode' => 'DEU', 'hub' => 'jakarta',  'x' => 245, 'y' => 105],
            ['negara' => 'Taiwan',   'kode' => 'TWN', 'hub' => 'yogyakarta', 'x' => 460, 'y' => 115],
            ['negara' => 'Jepang',   'kode' => 'JPN', 'hub' => 'yogyakarta', 'x' => 670, 'y' => 90],
            ['negara' => 'Filipina', 'kode' => 'PHL', 'hub' => 'yogyakarta', 'x' => 745, 'y' => 175],
        ];
    }

    // 5. Tampil halaman detail sertifikat di User
    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('pages.certificates.show', compact('certificate'));
    }
}
