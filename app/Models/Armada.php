<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    protected $table = 'armada';

    protected $fillable = [
        'no_plat',
        'jenis_kendaraan',
        'kapasitas',
        'driver_id',
        'status',
        'km_terakhir',
        'tanggal_servis_berikutnya',
        'merk',
        'tahun',
    ];

    protected $casts = [
        'tanggal_servis_berikutnya' => 'date',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'aktif'    => 'Aktif',
            'standby'  => 'Standby',
            'servis'   => 'Servis',
            'nonaktif' => 'Non-Aktif',
            default    => ucfirst($this->status),
        };
    }
}
