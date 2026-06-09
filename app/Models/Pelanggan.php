<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $fillable = [
        'nama_perusahaan',
        'nama_kontak',
        'no_hp',
        'email',
        'kota',
        'alamat',
        'status',
    ];

    public function pengiriman()
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getTotalPengirimanAttribute(): int
    {
        return Invoice::where('pelanggan_id', $this->id)->count();
    }

    public function getTotalNilaiAttribute(): float
    {
        return Invoice::where('pelanggan_id', $this->id)->sum('nominal');
    }
}
