<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';

    protected $fillable = [
        'nomor_polisi',
        'merk_kendaraan',
        'tipe_kendaraan',
        'tahun_operasi',
        'nama_supir',
        'telepon_supir',
        'alamat_supir',
        'user_id',
    ];

    public function penugasan()
    {
        return $this->hasMany(Penugasan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
