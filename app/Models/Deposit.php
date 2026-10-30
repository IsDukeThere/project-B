<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = ['user_id', 'jenis_sampah', 'berat_volume', 'metode', 'catatan', 'status', 'poin_didapat'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
