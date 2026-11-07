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
        $leaderboard = User::selectRaw('
            users.id, 
            users.name, 
            SUM(deposits.poin_didapat) as total_poin, 
            SUM(deposits.berat_volume) as total_kg 
        ')
        ->join('deposits', 'users.id', '=', 'deposits.user_id')

        ->where('users.role', 'customer')
        ->where('deposits.status', 'diterima')
        ->whereMonth('deposits.created_at', Carbon::now()->month)
        ->whereYear('deposits.created_at', Carbon::now()->year)

        ->groupBy('users.id', 'users.name')
        ->orderByDesc('total_poin')
        ->take(5)
        ->get();

        $pahlawanUtama = $leaderboard->first();
        $pahlawanLainnya = $leaderboard->slice(1, 4);

        return view('pages.home', compact(
            'products', 
            'poinMultilayer',
            'pahlawanUtama', 
            'pahlawanLainnya'
            ));
    }
}