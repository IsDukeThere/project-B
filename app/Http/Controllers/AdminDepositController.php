<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\PointConfig;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->get();
        return view('pages.admin.deposits', compact('deposits'));
    }

    public function verify(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);
        $config = PointConfig::where('jenis_sampah', $deposit->jenis_sampah)->first();
        
        if ($request->action == 'terima') {
            $poin = floor($deposit->berat_volume * $config->poin_per_satuan);

            $deposit->update([
                'status' => 'diterima',
                'poin_didapat' => $poin
            ]);

            $deposit->user->increment('total_poin', $poin);
            
            return back()->with('success', "Setoran diterima, +$poin Poin diberikan ke penyetor.");
        } 
        
        if ($request->action == 'tolak') {
            $deposit->update(['status' => 'ditolak']);
            return back()->with('success', 'Setoran berhasil ditolak.');
        }
    }
}
