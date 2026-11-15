<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Services\CloudinaryService;

class WorkshopController extends Controller
{
    // 1. Fungsi nampilin halaman Form Admin
    public function create()
    {
        $workshops = Workshop::latest()->get();
        return view('pages.admin.workshops', compact('workshops'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required|string',
            'kuota' => 'required|string',
            'biaya' => 'required|string',
            'deskripsi' => 'required|string',
            'registration_link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = CloudinaryService::upload($request->file('image'), 'project-b/workshops');
        }

        Workshop::create($validated);
        return redirect()->back()->with('success', 'Workshop berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $workshops = Workshop::latest()->get();
        $editWorkshop = Workshop::findOrFail($id);

        return view('pages.admin.workshops', compact('workshops', 'editWorkshop'));
    }

    public function update(Request $request, $id)
    {
        $workshop = Workshop::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required|string',
            'kuota' => 'required|string',
            'biaya' => 'required|string',
            'deskripsi' => 'required|string',
            'registration_link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = CloudinaryService::upload($request->file('image'), 'project-b/workshops');
        }

        $workshop->update($validated);
        return redirect()->route('admin.workshops.create')->with('success', 'Workshop berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $workshop = Workshop::findOrFail($id);

        if ($workshop->image && !str_starts_with($workshop->image, 'http')) {
            $storagePath = storage_path('app/public/workshops/' . basename($workshop->image));
            $publicPath = public_path($workshop->image);

            if (file_exists($storagePath) && is_writable($storagePath)) {
                @unlink($storagePath);
            } elseif (file_exists($publicPath) && is_writable($publicPath)) {
                @unlink($publicPath);
            }
        }

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
