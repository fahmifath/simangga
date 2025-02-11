<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKomponen extends Model
{
    protected $table = 'sub_komponen';

    protected $fillable = ['komponen_id', 'sub_komponen', 'kode'];

    public function komponen()
    {
        return $this->belongsTo(Komponen::class);
    }

    public function detils()
    {
        return $this->hasMany(Detil::class);
    }
}
