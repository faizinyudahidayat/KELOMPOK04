<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar 'nama_kategori' diizinkan masuk ke database
    protected $fillable = ['nama_kategori'];

    // Relasi ke Barang (Opsional tapi bagus untuk nanti)
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
