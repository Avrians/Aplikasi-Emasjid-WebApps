<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Null_;

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

    protected $casts = [
        'tanggal' => 'datetime:d-m-Y H:i'
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeSaldoAkhir($query, $masjidId = null)
    {
        $masjidId = $masjidId ?? auth()->user()->masjid_id;
        return   $query->where('masjid_id', $masjidId)
        ->orderBy('created_at', 'desc')->value('saldo_akhir');
    }
}
