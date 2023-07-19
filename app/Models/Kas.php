<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Null_;

class Kas extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid; 

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

    protected $casts = [
        'tanggal' => 'datetime:d-m-Y H:i'
    ];


    public function scopeSaldoAkhir($query, $masjidId = null)
    {
        $masjidId = $masjidId ?? auth()->user()->masjid_id;
        $masjid = Masjid::where('id', $masjidId)->first();
        return $masjid->saldo_akhir ?? 0;
    }
}
