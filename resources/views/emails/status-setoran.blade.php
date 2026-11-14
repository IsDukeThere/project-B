<x-mail::message>
# Halo, {{ $deposit->user->name ?? 'Sobat Project B' }}!

Setoran sampah Anda dengan kode transaksi **#{{ str_pad($deposit->id, 4, '0', STR_PAD_LEFT) }}** telah selesai diverifikasi oleh tim admin kami.

<x-mail::panel>
**Status Setoran:** {{ strtoupper($deposit->status) }}
**Jenis Sampah:** {{ $deposit->jenis_sampah }}
**Berat / Volume:** {{ $deposit->berat_volume }}
@if(!empty($deposit->metode))
**Metode Setoran:** {{ ucfirst($deposit->metode) }}
@endif
**Tanggal Pengajuan:** {{ $deposit->created_at->format('d M Y, H:i') }}
@if($deposit->status === 'diterima')
**Poin Didapat:** +{{ number_format($deposit->poin_didapat ?? 0, 0, ',', '.') }} Poin
@endif
**Total Poin Anda Saat Ini:** {{ number_format($deposit->user->total_poin ?? 0, 0, ',', '.') }} Poin
</x-mail::panel>

@if($deposit->status === 'diterima')
Selamat! Setoran Anda telah **diterima** dan poin otomatis ditambahkan ke akun Anda. Terus kumpulkan poinnya untuk ditukarkan dengan berbagai manfaat menarik!

@if(!empty($deposit->catatan))
**Catatan:** {{ $deposit->catatan }}
@endif
@elseif($deposit->status === 'ditolak')
Mohon maaf, setoran Anda **ditolak** saat ini.
@endif

<x-mail::button :url="url('/')">
Cek Riwayat & Poin Saya
</x-mail::button>

Terima kasih telah berkontribusi menjaga lingkungan,<br>
**Tim Project B Indonesia**
</x-mail::message>