<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';

    protected $fillable = [
        'kota_tujuan',
        'pulau_tujuan',
        'harga_per_kg',
        'catatan',
    ];
}
