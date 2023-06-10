<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'rentals';
    protected $fillable = [
        'nama', 'alamat', 'type', 'waktu_jam', 'total_harga', 'jam_mulai', 'supir', 'jam_selesai', 'tempat_tujuan', 'riwayat_perjalanan', 'status'
    ];
}
