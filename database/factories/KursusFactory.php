<?php

namespace Database\Factories;

use App\Enums\Kursus\KategoriEnum;
use App\Enums\Kursus\LevelEnum;
use App\Enums\Kursus\TipeEnum;
use App\Models\Kursus;
use Illuminate\Database\Eloquent\Factories\Factory;

class KursusFactory extends Factory
{
    protected $model = Kursus::class;
    protected static $counter = 1;

    public function definition(): array
    {
        $judul = 'Kursus-' . self::$counter;
        self::$counter++;

        return [
            'judul' => $judul,
            'slug' => str($judul)->slug(),
            'kategori' => $this->faker->randomElement(KategoriEnum::cases())->value,
            'deskripsi' => $this->faker->paragraph(3),
            'keypoints' => [
                $this->faker->sentence(),
                $this->faker->sentence(),
                $this->faker->sentence(),
            ],
            'level' => $this->faker->randomElement(LevelEnum::cases())->value,
            'tipe' => 'free',
            'harga' => 0,
            'is_published' => true,
            'resource_url' => $this->faker->url(),
        ];
    }
} 