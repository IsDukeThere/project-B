<?php

namespace App\Http\Controllers;

use App\Models\PointConfig;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

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

    public function indexPenyetor()
    {
        $products = Product::all();
        $totalProducts = $products->count();
        
        $layout = 'layouts.depositor';

        return view('pages.products.index', compact('products', 'totalProducts', 'layout'));
    }

    public function home()
    {
        $products = Product::take(4)->get(); 
        $poinMultilayer = PointConfig::where('jenis_sampah', 'Kemasan Multilayer')->value('poin_per_satuan') ?? 0;
        $leaderboard = User::where('role', 'customer')
            ->withSum(['deposits' => function ($query) {
                $query->where('status', 'diterima')
                      ->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
            }], 'poin_didapat')
            
            ->orderByDesc('deposits_sum_poin_didapat')
            ->take(10)
            ->get();

        return view('pages.home', compact(
            'products', 
            'poinMultilayer',
            'leaderboard'
            ));
    }
}