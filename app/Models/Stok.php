<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stoks';

    protected $fillable = [
        'tanggal',
        'jumlah_masuk',
        'jumlah_keluar',
        'jumlah_stok',
    ];
}
