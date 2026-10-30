<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit; // Ganti sesuai nama model Abang
use App\Models\Product; 
use App\Models\Workshop;
use App\Models\Certificate;
use App\Models\PointConfig;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $pendingDeposits = Deposit::where('status', 'menunggu')->count();
        $activeProducts = Product::count();
        $scheduledWorkshops = Workshop::where('tanggal', '>=', now())->count();
        $issuedCertificates = Certificate::count();
        
        // Ambil beberapa setoran terbaru untuk tabel di bawah
        $recentDeposits = Deposit::where('status', 'menunggu')
                                 ->orderBy('created_at', 'desc')
                                 ->take(5)
                                 ->get();

        $poinMultilayer = PointConfig::where('jenis_sampah', 'Kemasan Multilayer')->value('poin_per_satuan') ?? 0;
        $poinJelantah = PointConfig::where('jenis_sampah', 'Minyak Jelantah')->value('poin_per_satuan') ?? 0;

        // Kirim data ke view
        return view('pages.admin.dashboard', compact(
            'pendingDeposits', 
            'activeProducts', 
            'scheduledWorkshops', 
            'issuedCertificates',
            'recentDeposits',
            'poinMultilayer',
            'poinJelantah'
        ));
    }
}