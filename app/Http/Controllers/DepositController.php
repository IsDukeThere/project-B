<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\PointConfig;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DepositController extends Controller
{
    public function create()
    {
        $configs = PointConfig::all()->keyBy('jenis_sampah');
        return view('pages.depositor.deposit-form', compact('configs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah' => 'required|string',
            'berat_volume' => 'required|numeric|min:0.1',
            'metode' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        Deposit::create([
            'user_id' => Auth::id(),
            'jenis_sampah' => $request->jenis_sampah,
            'berat_volume' => str_replace(',', '.', $request->berat_volume),
            'metode' => $request->metode,
            'catatan' => $request->catatan,
            'status' => 'menunggu'
        ]);

        return redirect()->route('depositor.history')->with('success', 'Pengajuan setoran berhasil dikirim!');
    }

    public function history()
    {
        $deposits = Deposit::where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->latest()
                            ->get();
                            
        return view('pages.depositor.history', compact('deposits'));
    }

    public function leaderboard()
    {
        $leaderboard = User::where('role', 'customer')
            ->withSum(['deposits' => function ($query) {
                $query->where('status', 'diterima')
                      ->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
            }], 'poin_didapat')
            
            ->orderByDesc('deposits_sum_poin_didapat')
            ->take(10)
            ->get();

        return view('pages.depositor.leaderboard', compact('leaderboard'));
    }

    public function show($id)
    {
        $deposit = Deposit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('pages.depositor.deposit-detail', compact('deposit'));
    }

    public function destroy($id)
    {
        $deposit = Deposit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($deposit->status == 'menunggu') {
            $deposit->delete();
            return redirect()->route('depositor.history')->with('success', 'Setoran berhasil dibatalkan.');
        }

        return redirect()->back()->withErrors(['gagal' => 'Setoran sudah diproses, tidak bisa dibatalkan.']);
    }

    public function procedure()
    {
        $configs = \App\Models\PointConfig::all()->keyBy('jenis_sampah');
        
        return view('pages.depositor.procedure', compact('configs'));
    }
}