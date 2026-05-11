<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'barangs';

    // Kolom yang boleh diisi (Keamanan Mass Assignment)
    protected $fillable = [
        'category_id',
        'nama_barang',
        'merk',
        'spesifikasi',
        'stok',
        'harga'
    ];

    /**
     * Relasi ke Kategori (Barang memiliki satu kategori)
     * Agar data di HP bisa menampilkan nama kategori, bukan hanya ID
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
