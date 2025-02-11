<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RO extends Model
{
    protected $table = 'ro';

    protected $fillable = ['ro', 'kode', 'iku_id'];

    public function iku()
    {
        return $this->belongsTo(IKU::class);
    }

    public function komponens()
    {
        return $this->hasMany(Komponen::class, 'ro_id');
    }
}
