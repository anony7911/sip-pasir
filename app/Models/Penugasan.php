<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penjualan_id',
        'kendaraan_id',
        'jumlah_truk',
        'status',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
