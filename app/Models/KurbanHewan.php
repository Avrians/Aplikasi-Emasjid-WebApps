<?php

namespace App\Models;

use App\Traits\HasMasjid;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KurbanHewan extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;

    protected $guarded = [];

    protected $appends = ['nama_full'];
    public function getNamaFullAttribute()
    {
        return ucwords($this->hewan) . " - {$this->kriteria} - " . formatRupiah($this->iuran_perorang);
    }

    public function kurban()
    {
        return $this->belongsTo(Kurban::class);
    }

    public function kurbanPesertas(): HasMany
    {
        return $this->hasMany(KurbanPeserta::class);
    }
}
