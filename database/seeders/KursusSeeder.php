<?php

namespace Database\Seeders;

use App\Models\Kursus;
use App\Models\KursusMentor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KursusSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 100 kursus
        $kursus = Kursus::factory(100)->create();

        // Tambahkan mentor untuk setiap kursus
        foreach ($kursus as $k) {
            // Ambil random mentor_id antara 1-10
            $mentorId = rand(1, 10);
            
            KursusMentor::create([
                'kursus_id' => $k->id,
                'mentor_id' => $mentorId
            ]);

            // Tambahkan thumbnail menggunakan spatie media library
            $k->addMediaFromUrl('https://picsum.photos/800/400')
                ->toMediaCollection('kursus-thumbnail');
        }
    }
} 