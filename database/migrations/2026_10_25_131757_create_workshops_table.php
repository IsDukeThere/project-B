<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('judul');              // Misal: Membuat Dompet dari Plastik
            $table->date('tanggal');              // Misal: 2026-10-12
            $table->string('jam');                // Misal: 09.00
            $table->string('kuota');              // Misal: 20 kursi
            $table->string('biaya');              // Misal: Gratis / Rp 50.000
            $table->text('deskripsi');            // Deskripsi singkat
            $table->string('registration_link')->nullable(); // Link daftar (bisa kosong)
            $table->timestamps();                 // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
