<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Mendefinisikan nama table yang digunakan
    protected $table = 'produks';

    // Mendefinisikan kolom yang dapat diisi
    protected $fillable = [
        'nama_produk',
        'slug',
        'deskripsi',
        'harga',
        'gambar'
    ];

    // Mendefinisikan relasi ke tabel penjualans
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    // Mendefinisikan relasi ke tabel keranjangs
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

}
