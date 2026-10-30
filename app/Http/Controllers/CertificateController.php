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
        return view('pages.certificates.index', compact('certificates'));
    }

    // 5. Tampil halaman detail sertifikat di User
    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('pages.certificates.show', compact('certificate'));
    }
}
