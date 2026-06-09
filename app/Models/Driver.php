<?php
// app/Models/Driver.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'nama', 'no_hp', 'no_lisensi', 'jenis_sim',
        'rute_aktif', 'total_trip', 'rating', 'status', 'foto',
    ];

    public function armada()
    {
        return $this->hasMany(Armada::class);
    }

    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'aktif'    => 'Aktif',
            'libur'    => 'Libur',
            'nonaktif' => 'Non-Aktif',
            default    => ucfirst($this->status),
        };
    }
}
