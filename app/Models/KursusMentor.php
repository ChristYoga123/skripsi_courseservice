<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusMentor extends Model
{
    public $timestamps = false;

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}
