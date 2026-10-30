@extends('layouts.depositor')

@section('title', 'Form Setor Sampah')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <a href="{{ route('depositor.procedure') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-emerald-700">
        ← Kembali ke Panduan
    </a>

    <!-- Alert Sukses/Error -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 rounded-xl font-bold text-sm border border-emerald-200">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="p-4 bg-rose-50 text-rose-700 rounded-xl font-bold text-sm border border-rose-200">❌ Cek kembali isian form Anda.</div>
    @endif

    <div class="pb-card p-6 sm:p-8 space-y-6">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Form Setor Sampah</h1>
            <p class="text-xs text-slate-500 mt-1">Masukkan perkiraan berat dan metode serah untuk diteruskan ke admin</p>
        </div>

        <form action="{{ route('depositor.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">Jenis Sampah</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="border rounded-2xl p-4 flex flex-col items-center text-center cursor-pointer radio-label border-emerald-600 bg-emerald-50/50 has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/50 hover:bg-slate-50">
                        <input type="radio" name="jenis_sampah" value="Kemasan Multilayer" data-poin="{{ $configs['Kemasan Multilayer']->poin_per_satuan ?? 10 }}" checked class="sr-only waste-radio">
                        <span class="text-3xl mb-1">🍜</span>
                        <span class="text-xs font-bold text-slate-900">Kemasan Multilayer</span>
                        <span class="text-[10px] text-emerald-700 font-semibold mt-0.5">{{ $configs['Kemasan Multilayer']->poin_per_satuan ?? 10 }} poin/kg</span>
                    </label>

                    <label class="border rounded-2xl p-4 flex flex-col items-center text-center cursor-pointer radio-label border-slate-200 has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/50 hover:bg-slate-50">
                        <input type="radio" name="jenis_sampah" value="Minyak Jelantah" data-poin="{{ $configs['Minyak Jelantah']->poin_per_satuan ?? 10 }}" class="sr-only waste-radio">
                        <span class="text-3xl mb-1">🛢️</span>
                        <span class="text-xs font-bold text-slate-900">Minyak Jelantah</span>
                        <span class="text-[10px] text-emerald-700 font-semibold mt-0.5">{{ $configs['Minyak Jelantah']->poin_per_satuan ?? 10 }} poin/liter</span>
                    </label>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="block text-xs font-bold text-slate-700">Perkiraan Jumlah (kg/L)</label>
                </div>
                <input type="number" id="beratInput" name="berat_volume" step="0.1" min="0.1" value="{{ old('berat_volume', '1.0') }}" class="pb-input font-bold text-base" required />
            </div>

            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center justify-between transition-all">
                <span class="text-xs font-semibold text-emerald-900">Estimasi Poin Reward:</span>
                <span id="estimasiPoin" class="font-extrabold text-base text-emerald-700">+0 Poin</span>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2">Metode Penyerahan</label>
                <div class="space-y-2">
                    <label class="flex items-center gap-3 p-3.5 border rounded-2xl cursor-pointer hover:bg-slate-50 border-slate-300">
                        <input type="radio" name="metode" value="Drop Langsung" checked class="text-emerald-600 focus:ring-emerald-500" />
                        <div>
                            <span class="text-xs font-bold text-slate-900 block">Drop Langsung ke Butik Daur Ulang</span>
                            <span class="text-[10px] text-slate-500">Jl. Contoh No. 12, Yogyakarta (08.00–20.00 WIB)</span>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-3.5 border rounded-2xl cursor-pointer hover:bg-slate-50 border-slate-300">
                        <input type="radio" name="metode" value="Kirim via Ekspedisi" class="text-emerald-600 focus:ring-emerald-500" />
                        <div>
                            <span class="text-xs font-bold text-slate-900 block">Kirim via Ekspedisi / Kurir</span>
                            <span class="text-[10px] text-slate-500">Ongkir ditanggung mandiri ke alamat workshop</span>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
                <textarea name="catatan" rows="2" class="pb-input text-xs" placeholder="Misal: Sudah dipilah dan dikeringkan">{{ old('catatan') }}</textarea>
            </div>

            <button type="submit" class="pb-btn-primary w-full py-3.5">
                Kirim Pengajuan Setoran →
            </button>
        </form>
    </div>
</div>

<script>
    // JS Kalkulasi Poin Otomatis
    const radios = document.querySelectorAll('.waste-radio');
    const beratInput = document.getElementById('beratInput');
    const estimasiPoin = document.getElementById('estimasiPoin');

    function updatePoin() {
        const checkedRadio = document.querySelector('.waste-radio:checked');
        const poinPerSatuan = parseFloat(checkedRadio.dataset.poin) || 0;
        const berat = parseFloat(beratInput.value) || 0;
        
        const total = Math.floor(poinPerSatuan * berat);
        estimasiPoin.textContent = '+' + total + ' Poin';
    }

    radios.forEach(radio => radio.addEventListener('change', updatePoin));
    beratInput.addEventListener('input', updatePoin);
    
    // Hitung saat halaman pertama kali diload
    updatePoin();
</script>
@endsection