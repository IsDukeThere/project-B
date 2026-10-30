<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('workshops', function (Blueprint $table) {
            // Kolom image nullable() artinya opsional (boleh kosong)
            $table->string('image')->nullable()->after('deskripsi'); 
        });
    }

    public function down()
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
