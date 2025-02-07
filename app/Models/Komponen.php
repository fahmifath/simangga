<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $fillable = ['komponen', 'kode'];

    public function subKomponens()
    {
        return $this->hasMany(SubKomponen::class);
    }
}
