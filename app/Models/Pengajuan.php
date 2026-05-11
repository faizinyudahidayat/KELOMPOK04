<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom mana saja yang boleh diisi secara massal.
     * Sesuai dengan tabel migration yang tadi kita buat.
     */
    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah',
        'alasan',
        'status',
    ];

    /**
     * Relasi ke model User.
     * Satu pengajuan dimiliki oleh satu User (Karyawan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Barang.
     * Satu pengajuan merujuk pada satu Barang.
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
