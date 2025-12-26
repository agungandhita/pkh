<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilSaw extends Model
{
    protected $table = 'hasil_saw';

    protected $fillable = [
        'warga_id',
        'nilai_preferensi',
        'peringkat',
        'status_kelayakan',
    ];

    protected $casts = [
        'nilai_preferensi' => 'decimal:6',
        'peringkat' => 'integer',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(Warga::class);
    }
}
