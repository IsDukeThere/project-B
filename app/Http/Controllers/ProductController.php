<?php

namespace App\Http\Controllers;

use App\Models\PointConfig;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi input & file gambar
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // 2. Proses upload gambar ke folder public/storage/products
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // 3. Simpan ke database
        Product::create($validated);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function index()
    {
        $products = Product::all();
        $totalProducts = $products->count();

        return view('pages.products.index', compact('products', 'totalProducts'));
    }

    public function home()
    {
        $products = Product::take(4)->get(); 
        $poinMultilayer = PointConfig::where('jenis_sampah', 'Kemasan Multilayer')->value('poin_per_satuan') ?? 0;

        return view('pages.home', compact('products', 'poinMultilayer'));
    }
}