<?php

namespace App\Models;

use App\Traits\HasMasjid;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KurbanHewan extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid;

    protected $guarded = [];

    public function kurban() {
        return $this->belongsTo(Kurban::class);
    }

}
