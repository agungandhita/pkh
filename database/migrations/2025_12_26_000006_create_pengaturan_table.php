<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->decimal('threshold_kelayakan', 10, 6)->default(0.600000);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
