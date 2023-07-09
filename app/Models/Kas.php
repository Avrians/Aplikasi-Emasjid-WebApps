<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $table = "kas";
    protected $fillable = [
        'masjid_id',
        'tanggal',
        'kategori',
        'keterangan',
        'jenis',
        'jumlah',
        'created_by',
    ];
}
