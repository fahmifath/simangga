<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SasaranKegiatan extends Model
{
    protected $table = 'sasaran_kegiatan';

    protected $fillable = ['sasaran_kegiatan'];

    public function ikus()
    {
        return $this->hasMany(IKU::class);
    }
}
