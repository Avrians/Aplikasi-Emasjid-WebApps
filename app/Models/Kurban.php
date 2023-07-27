<?php

namespace App\Models;

use App\Traits\HasMasjid;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ConvertContentImageBase64ToUrl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Expr\FuncCall;

class Kurban extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;
    use ConvertContentImageBase64ToUrl;

    protected $contentName = 'konten';
    protected $guarded = [];
    protected $casts = [
        'tanggal_akhir_pendaftaran' => 'date',
    ];

    public function kurbanHewan(): HasMany
    {
        return $this->hasMany(KurbanHewan::class);
    }
}
