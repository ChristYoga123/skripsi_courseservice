<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kursus_murids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kursus_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('student_id');
            $table->boolean('is_selesai')->default(false);
            $table->unsignedInteger('rating')->nullable();
            $table->longText('komentar')->nullable();
            $table->timestamps();

            $table->unique(['kursus_id', 'student_id'], 'kursus_murids_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_murids');
    }
};
