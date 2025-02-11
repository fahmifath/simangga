<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDetil extends Model
{
    protected $table = 'sub_detil';

    protected $fillable = ['detil_id', 'sub_detil'];

    public function detil()
    {
        return $this->belongsTo(Detil::class);
    }
}

