<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria', 16)->unique();
            $table->string('nama_kriteria');
            $table->decimal('bobot', 10, 6);
            $table->string('jenis_atribut', 16);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->index(['status', 'jenis_atribut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kriteria');
    }
};
