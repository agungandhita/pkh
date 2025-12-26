<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_saw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->decimal('nilai_preferensi', 10, 6);
            $table->unsignedInteger('peringkat');
            $table->string('status_kelayakan', 16);
            $table->timestamps();

            $table->unique('warga_id');
            $table->index(['peringkat', 'status_kelayakan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_saw');
    }
};
