<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Setoran Sampah - Project B Indonesia</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1f2937;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6; padding: 24px 12px;">
        <tr>
            <td align="center">
                <!-- Card Utama -->
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 560px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);">

                    <!-- Header Hijau Emerald -->
                    <tr>
                        <td style="background-color: #065f46; padding: 24px 28px; text-align: center;">
                            <p style="margin: 0; font-size: 12px; letter-spacing: 1.5px; text-transform: uppercase; color: #a7f3d0; font-weight: 700;">
                                Bank Sampah Digital
                            </p>
                            <h1 style="margin: 6px 0 0; font-size: 22px; font-weight: 800; color: #ffffff;">
                                Project B Indonesia
                            </h1>
                        </td>
                    </tr>

                    <!-- Konten Utama -->
                    <tr>
                        <td style="padding: 28px 24px;">
                            <h2 style="margin: 0 0 12px; font-size: 18px; font-weight: 700; color: #111827;">
                                Halo, {{ $deposit->user->name ?? 'Sobat Project B' }}!
                            </h2>
                            <p style="margin: 0 0 20px; font-size: 14px; line-height: 1.6; color: #4b5563;">
                                Setoran sampah Anda dengan kode transaksi <strong style="color: #111827;">#{{ str_pad($deposit->id, 4, '0', STR_PAD_LEFT) }}</strong> telah selesai diverifikasi oleh tim admin kami.
                            </p>

                            <!-- Kotak Rincian Transaksi -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; margin-bottom: 20px;">
                                <tr>
                                    <td style="padding: 8px 0; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Status Setoran</td>
                                    <td align="right" style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                                        @if($deposit->status === 'diterima')
                                            <span style="display: inline-block; background-color: #d1fae5; color: #065f46; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 999px; letter-spacing: 0.5px;">
                                                DITERIMA
                                            </span>
                                        @else
                                            <span style="display: inline-block; background-color: #fee2e2; color: #991b1b; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 999px; letter-spacing: 0.5px;">
                                                DITOLAK
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Jenis Sampah</td>
                                    <td align="right" style="padding: 8px 0; font-size: 13px; font-weight: 600; color: #111827; border-bottom: 1px solid #e5e7eb;">
                                        {{ $deposit->jenis_sampah }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Berat / Volume</td>
                                    <td align="right" style="padding: 8px 0; font-size: 13px; font-weight: 600; color: #111827; border-bottom: 1px solid #e5e7eb;">
                                        {{ $deposit->berat_volume }}
                                    </td>
                                </tr>
                                @if(!empty($deposit->metode))
                                <tr>
                                    <td style="padding: 8px 0; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Metode Setoran</td>
                                    <td align="right" style="padding: 8px 0; font-size: 13px; font-weight: 600; color: #111827; border-bottom: 1px solid #e5e7eb;">
                                        {{ ucfirst($deposit->metode) }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 8px 0; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Tanggal Pengajuan</td>
                                    <td align="right" style="padding: 8px 0; font-size: 13px; font-weight: 600; color: #111827; border-bottom: 1px solid #e5e7eb;">
                                        {{ $deposit->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                    </td>
                                </tr>
                                @if($deposit->status === 'diterima')
                                <tr>
                                    <td style="padding: 8px 0; font-size: 13px; color: #6b7280; border-bottom: 1px solid #e5e7eb;">Poin Didapat</td>
                                    <td align="right" style="padding: 8px 0; font-size: 14px; font-weight: 800; color: #059669; border-bottom: 1px solid #e5e7eb;">
                                        +{{ number_format($deposit->poin_didapat ?? 0, 0, ',', '.') }} Poin
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 10px 0 2px; font-size: 13px; font-weight: 700; color: #111827;">Total Poin Anda Saat Ini</td>
                                    <td align="right" style="padding: 10px 0 2px; font-size: 15px; font-weight: 800; color: #065f46;">
                                        {{ number_format($deposit->user->total_poin ?? 0, 0, ',', '.') }} Poin
                                    </td>
                                </tr>
                            </table>

                            <!-- Kotak Template Catatan Otomatis -->
                            @if($deposit->status === 'diterima')
                                <div style="background-color: #ecfdf5; border-left: 4px solid #10b981; border-radius: 8px; padding: 14px 16px; margin-bottom: 24px;">
                                    <p style="margin: 0 0 4px; font-size: 13px; font-weight: 700; color: #065f46;">
                                        Verifikasi Berhasil!
                                    </p>
                                    <p style="margin: 0; font-size: 13px; line-height: 1.5; color: #047857;">
                                        Terima kasih telah memilah dan membersihkan sampah sesuai standar. Poin sudah otomatis masuk ke saldo akun Anda dan siap ditukarkan.
                                    </p>
                                </div>
                            @else
                                <div style="background-color: #fef2f2; border-left: 4px solid #ef4444; border-radius: 8px; padding: 14px 16px; margin-bottom: 24px;">
                                    <p style="margin: 0 0 6px; font-size: 13px; font-weight: 700; color: #991b1b;">
                                        Catatan Verifikasi:
                                    </p>
                                    <p style="margin: 0; font-size: 13px; line-height: 1.5; color: #7f1d1d;">
                                        Setoran belum memenuhi standar kebersihan atau pemilahan. Pastikan kemasan sudah <strong>dicuci bersih dari sisa makanan/minuman, dikeringkan, dan dipilah sesuai jenisnya</strong> (cek video panduan di website) sebelum mengajukan ulang.
                                    </p>
                                </div>
                            @endif

                            <!-- Tombol CTA -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('https://project-b-k8tf.onrender.com/penyetor/riwayat') }}" style="display: inline-block; background-color: #065f46; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 700; padding: 12px 28px; border-radius: 10px;">
                                            Cek Riwayat &amp; Poin Saya
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 18px 24px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0 0 4px; font-size: 12px; color: #6b7280;">
                                Terima kasih telah berkontribusi menjaga lingkungan bersama <strong>Project B Indonesia</strong>.
                            </p>
                            <p style="margin: 0; font-size: 11px; color: #9ca3af;">
                                &copy; {{ date('Y') }} Project B Indonesia. Email ini dikirim secara otomatis.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>