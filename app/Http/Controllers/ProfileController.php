<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalBeratBulanIni = Deposit::where('user_id', $user->id)
            ->where('status', 'diterima')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('berat_volume');

        $totalPoin = Deposit::where('user_id', $user->id)
            ->where('status', 'diterima')
            ->sum('poin_didapat');

        $allPenyetor = User::where('role', 'customer')
            ->withSum(['deposits' => function ($query) {
                $query->where('status', 'diterima')
                      ->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
            }], 'poin_didapat')
            ->orderByDesc('deposits_sum_poin_didapat')
            ->get();

        $peringkat = '-';
        foreach ($allPenyetor as $index => $p) {
            if ($p->id == $user->id) {
                $peringkat = $index + 1;
                break;
            }
        }

        return view('pages.depositor.profile', compact('user', 'totalBeratBulanIni', 'totalPoin', 'peringkat'));
    }
}
