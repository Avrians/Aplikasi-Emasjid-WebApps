<?php

namespace App\Models;

use App\Traits\HasMasjid;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid, GenerateSlug;

    protected $guarded = [];


    public function informasi(): HasMany
    {
        return $this->hasMany(Informasi::class);
    }
}
