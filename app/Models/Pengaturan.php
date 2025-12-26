<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    public $timestamps = false;

    protected $fillable = [
        'threshold_kelayakan',
    ];

    protected $casts = [
        'threshold_kelayakan' => 'decimal:6',
    ];
}
