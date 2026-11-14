<?php

namespace App\Http\Controllers;

use App\Mail\StatusSetoranMail;
use App\Models\Deposit;
use App\Models\PointConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->get();
        return view('pages.admin.deposits', compact('deposits'));
    }

    public function verify(Request $request, $id)
    {
        $deposit = Deposit::with('user')->findOrFail($id);
        $pesan = '';

        if ($request->action == 'terima') {
            $config = PointConfig::where('jenis_sampah', $deposit->jenis_sampah)->first();
            $poin = $config ? floor($deposit->berat_volume * $config->poin_per_satuan) : 0;

            $deposit->update([
                'status' => 'diterima',
                'poin_didapat' => $poin,
            ]);

            if ($deposit->user) {
                $deposit->user->increment('total_poin', $poin);
                $deposit->user->refresh();
            }

            $pesan = "Setoran diterima, +$poin Poin diberikan ke penyetor.";
        } elseif ($request->action == 'tolak') {
            $deposit->update(['status' => 'ditolak']);
            $pesan = 'Setoran berhasil ditolak.';
        } else {
            return back()->with('error', 'Aksi tidak valid.');
        }

        if ($deposit->user && $deposit->user->email) {
            try {
                Mail::to($deposit->user->email)->send(new StatusSetoranMail($deposit));
            } catch (\Exception $e) {
                Log::error('Gagal kirim email notifikasi setoran: ' . $e->getMessage());
            }
        }

        return back()->with('success', $pesan);
    }
}