<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $fillable = [
        'sasaran_kegiatan_id',
        'iku_id',
        'ro_id',
        'komponen_id',
        'sub_komponen_id',
        'detil_id',
        'sub_detil_id',
        'pengaju',
        'qty',
        'harga_satuan',
    ];

    public function sasaranKegiatan()
    {
        return $this->belongsTo(SasaranKegiatan::class);
    }

    public function iku()
    {
        return $this->belongsTo(IKU::class);
    }

    public function ro()
    {
        return $this->belongsTo(RO::class);
    }

    public function komponen()
    {
        return $this->belongsTo(Komponen::class);
    }

    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class);
    }

    public function detil()
    {
        return $this->belongsTo(Detil::class);
    }

    public function subDetil()
    {
        return $this->belongsTo(SubDetil::class);
    }
}
