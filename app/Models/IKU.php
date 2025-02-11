<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IKU extends Model
{
    protected $table = 'iku';
    
    protected $fillable = ['iku', 'sasaran_kegiatan_id'];

    public function ros()
    {
        return $this->hasMany(RO::class);
    }

    public function sasaranKegiatan()
    {
        return $this->belongsTo(SasaranKegiatan::class);
    }
}
