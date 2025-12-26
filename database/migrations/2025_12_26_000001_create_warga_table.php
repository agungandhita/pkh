<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 32)->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('rt', 4);
            $table->string('rw', 4);
            $table->boolean('status_dtks')->default(false);
            $table->timestamps();

            $table->index(['rw', 'rt']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
