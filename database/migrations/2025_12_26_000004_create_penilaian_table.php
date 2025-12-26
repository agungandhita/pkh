<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->foreignId('kriteria_id')->constrained('kriteria')->cascadeOnDelete();
            $table->decimal('nilai', 10, 6);
            $table->timestamps();

            $table->unique(['warga_id', 'kriteria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
