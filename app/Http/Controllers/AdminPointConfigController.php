<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointConfig;

class AdminPointConfigController extends Controller
{
    public function edit()
    {
        $configs = PointConfig::all();

        if ($configs->isEmpty()) {
            PointConfig::insert([
                ['jenis_sampah' => 'Kemasan Multilayer', 'poin_per_satuan' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['jenis_sampah' => 'Minyak Jelantah', 'poin_per_satuan' => 10, 'created_at' => now(), 'updated_at' => now()],
            ]);
            $configs = PointConfig::all();
        }

        return view('pages.admin.points-config', compact('configs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'poin' => 'required|array',
            'poin.*' => 'required|integer|min:1'
        ]);

        foreach ($request->poin as $id => $nilai_poin) {
            PointConfig::where('id', $id)->update(['poin_per_satuan' => $nilai_poin]);
        }

        return redirect()->back()->with('success', 'Pengaturan poin berhasil diperbarui!');
    }
}
