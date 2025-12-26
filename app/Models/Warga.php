<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Warga extends Model
{
    protected $table = 'warga';

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'rt',
        'rw',
        'status_dtks',
    ];

    protected $casts = [
        'status_dtks' => 'boolean',
    ];

    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasilSaw(): HasOne
    {
        return $this->hasOne(HasilSaw::class);
    }
}
