<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Masjid extends Model
{
    use HasFactory;

    protected $guarded = [];

    // versi lama
    // protected $fillable = [
    //     'nama',
    //     'alamat',
    //     'telp',
    //     'email',
    //     'saldo_akhir',
    // ];

    // versi baru
    // public function getSlugOptions(): SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugFrom('nama')
    //         ->saveSlugTo('slug');
    // }

    public function profils(): HasMany
    {
        return $this->hasMany(Profil::class);
    }

    public function kategori(): HasMany
    {
        return $this->hasMany(Kategori::class);
    }

    public function informasi(): HasMany
    {
        return $this->hasMany(Informasi::class);
    }

    public function kas(): HasMany
    {
        return $this->hasMany(Kas::class);
    }
}
