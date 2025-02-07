<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detil extends Model
{
    protected $fillable = ['sub_komponen_id', 'detil', 'kode'];

    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class, 'sub_komponen_id');
    }

    public function subDetils()
    {
        return $this->hasMany(SubDetil::class);
    }

}
