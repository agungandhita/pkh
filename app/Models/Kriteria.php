<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    protected $table = 'kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'jenis_atribut',
        'status',
    ];

    protected $casts = [
        'bobot' => 'decimal:6',
        'status' => 'boolean',
    ];

    public function subKriteria(): HasMany
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }
}
