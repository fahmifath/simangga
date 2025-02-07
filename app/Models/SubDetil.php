<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDetil extends Model
{
    protected $fillable = ['detil_id', 'sub_detil'];

    public function detil()
    {
        return $this->belongsTo(Detil::class);
    }
}

