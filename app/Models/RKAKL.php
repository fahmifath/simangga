<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RKAKL extends Model
{
    protected $table = 'rkakl';

    protected $fillable = [
        'komponen_id',
        'sub_komponen_id',
        'detil_id',
        'sub_detil_id',
        'kode',
        'uraian',
        'volume',
        'satuan',
        'harga',
        'jumlah',
        'tahun',
    ];

    public function komponens()
    {
        return $this->belongsToMany(Komponen::class);
    }

    public function subKomponens()
    {
        return $this->belongsToMany(SubKomponen::class);
    }

    public function detils()
    {
        return $this->belongsToMany(Detil::class);
    }

    public function subDetils()
    {
        return $this->belongsToMany(SubDetil::class);
    }
}
