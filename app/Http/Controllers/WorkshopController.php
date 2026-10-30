<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;

class WorkshopController extends Controller
{
    // 1. Fungsi nampilin halaman Form Admin
    public function create()
    {
    $workshops = Workshop::latest()->get(); 

    return view('pages.admin.workshops', compact('workshops'));
    }

    // 2. Fungsi buat nyimpen data ke Database pas tombol "Simpan" diklik
    public function store(Request $request)
    {
        // Validasi semua inputan, termasuk link pendaftaran
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required|string',
            'kuota' => 'required|string',
            'biaya' => 'required|string',
            'deskripsi' => 'required|string',
            'registration_link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/workshops'), $imageName);
            $validated['image'] = 'images/workshops/' . $imageName;
        }

        // Masukin ke database
        Workshop::create($validated);

        return redirect()->back()->with('success', 'Workshop berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $workshop = Workshop::findOrFail($id);
        
        // Hapus file gambar dari folder public jika ada
        if ($workshop->image && file_exists(public_path($workshop->image))) {
            unlink(public_path($workshop->image));
        }
        
        // Hapus data dari database
        $workshop->delete();

        return redirect()->back()->with('success', 'Workshop berhasil dihapus!');
    }

    // 3. Fungsi nampilin data di halaman User (Card Hijau)
    public function index()
    {

        $workshops = Workshop::latest()->get();
        
        return view('pages.workshops.index', compact('workshops')); 
    }
}
