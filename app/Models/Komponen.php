<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = 'komponen';

    protected $fillable = ['ro_id','komponen', 'kode'];

    public function ro()
    {
        return $this->belongsTo(RO::class, 'ro_id');
    }

    public function subKomponens()
    {
        return $this->hasMany(SubKomponen::class);
    }
}
