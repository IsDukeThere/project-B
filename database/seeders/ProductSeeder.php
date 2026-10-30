<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Jangan lupa panggil model Product-nya

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        //product 1
        Product::create([
            'name' => 'Buku',
            'link' => 'https://id.shp.ee/UisPPyKa ',
            'description' => 'Beragam buku untuk menambah wawasan dan pengetahuan, mendukung kegiatan belajar, serta meningkatkan minat baca.',
            'image' => 'images/WhatsApp Image 2026-10-24 at 20.10.34.jpeg',
        ]);

        //product 2
        Product::create([
            'name' => 'Pencil Case Edition',
            'link' => 'https://shopee.co.id/butikdaurulang_1?shopCollection=246629097#product_list',
            'description' => 'Tempat pensil kreatif dari limbah plastik yang cocok untuk menyimpan alat tulis dengan praktis dan tetap stylish.',
            'image' => 'images/WhatsApp Image 2026-10-24 at 17.31.38.jpeg',
        ]);

        //product 3
        Product::create([
            'name' => 'Tas anyaman plastik',
            'link' => 'https://shopee.co.id/butikdaurulang_1?page=0&shopCollection=246629074',
            'description' => 'Tas yang dibuat dari anyaman limbah plastik dengan motif dan warna yang beragam. Produk ini kuat, unik, dan fungsional untuk digunakan sehari-hari sekaligus mendukung pemanfaatan kembali sampah plastik.',
            'image' => 'images/WhatsApp Image 2026-10-24 at 17.33.34.jpeg',
        ]);

        //product 4
        Product::create([
            'name' => 'Dekorasi & Perlengkapan Rumah Tangga',
            'link' => 'https://shopee.co.id/butikdaurulang_1?page=0&shopCollection=246628938',
            'description' => 'Berbagai produk dekorasi dan perlengkapan rumah tangga kreatif yang memiliki fungsi sekaligus nilai estetika.',
            'image' => 'images/WhatsApp Image 2026-10-24 at 17.34.39.jpeg',
        ]);

        //product 5
        Product::create([
            'name' => 'Backpack Edition',
            'link' => 'https://shopee.co.id/butikdaurulang_1?page=0&shopCollection=246628920',
            'description' => 'Tas punggung dengan desain unik dan fungsional, cocok digunakan untuk membawa berbagai kebutuhan saat beraktivitas.',
            'image' => 'images/WhatsApp Image 2026-10-24 at 17.36.06.jpeg',
        ]);

        //product 6
        Product::create([
            'name' => 'Totebag – Goodiebag Edition',
            'link' => 'https://shopee.co.id/butikdaurulang_1?shopCollection=246629093#product_list',
            'description' => 'Perlengkapan penyimpanan produk kecantikan dengan desain menarik dan praktis untuk menemani aktivitas sehari-hari.',
            'image' => 'images/WhatsApp Image 2026-10-24 at 17.37.26.jpeg',
        ]);

        //product 7
        Product::create([
            'name' => 'Beauty Kit Edition',
            'link' => 'https://id.shp.ee/UisPPyKa ',
            'description' => 'Beragam buku untuk menambah wawasan dan pengetahuan, mendukung kegiatan belajar, serta meningkatkan minat baca.',
            'image' => 'images/WhatsApp Image 2026-10-24 at 20.11.25.jpeg',
        ]);

        //product 8
        Product::create([
            'name' => 'Wallet Edition',
            'link' => 'https://shopee.co.id/butikdaurulang_1?shopCollection=246629104#product_list',
            'description' => 'Dompet unik yang dibuat dari limbah plastik kemasan bekas dengan desain menarik, praktis, dan ramah lingkungan.',
            'image' => 'images/wallet Edition.jpeg',
        ]);

        //product 9
        Product::create([
            'name' => 'tas belanja',
            'link' => 'https://shopee.co.id/butikdaurulang_1?page=0&shopCollection=246629062',
            'description' => 'Tas belanja ramah lingkungan yang dapat digunakan kembali sebagai alternatif untuk mengurangi penggunaan kantong plastik sekali pakai.',
            'image' => 'images/tas belanja.jpeg',
        ]);
    }
}