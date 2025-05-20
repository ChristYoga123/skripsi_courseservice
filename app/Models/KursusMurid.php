<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusMurid extends Model
{
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}
