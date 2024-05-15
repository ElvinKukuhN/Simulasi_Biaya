<?php

namespace App\Models;

use App\Traits\UuidTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulasiBiaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'uraian_barang',
        'bm',
        'nilai_komoditas',
        'nilai_bm',
    ];

    use UuidTraits;
}
