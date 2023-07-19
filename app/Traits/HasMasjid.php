<?php

namespace App\Traits;

use App\Models\Masjid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasMasjid
{
  protected static function bootHasMasjid()
  {
    static::creating(function ($model) {
      $model->masjid_id = auth()->user()->masjid_id;
    });
  }

  public function scopeUserMasjid($q)
  {
      return $q->where('masjid_id', auth()->user()->masjid_id);
  }

  public function masjid(): BelongsTo
  {
      return $this->belongsTo(Masjid::class);
  }
}
