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
        Schema::create('kursus_mentors', function (Blueprint $table) {
            $table->foreignId('kursus_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('mentor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursus_mentors');
    }
};
