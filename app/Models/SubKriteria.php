<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubKriteria extends Model
{
    protected $table = 'sub_kriteria';

    protected $fillable = [
        'kriteria_id',
        'nama_sub_kriteria',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'integer',
    ];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }
}
