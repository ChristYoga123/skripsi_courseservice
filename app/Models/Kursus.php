<?php

namespace App\Models;

use App\Enums\Kursus\KategoriEnum;
use App\Enums\Kursus\LevelEnum;
use App\Enums\Kursus\TipeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Kursus extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    protected $casts = [
        'keypoints' => 'array',
        'kategori' => KategoriEnum::class,
        'level' => LevelEnum::class,
        'tipe' => TipeEnum::class,
    ];

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucwords($value);
        $this->attributes['slug'] = str($value)->slug();
    }

    public function mentors()
    {
        return $this->hasMany(KursusMentor::class);
    }

    public function students()
    {
        return $this->hasMany(KursusMurid::class);
    }
}
