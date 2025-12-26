<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = [
        'warga_id',
        'kriteria_id',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'decimal:6',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }
}
