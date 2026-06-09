<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingHistory extends Model
{
    protected $table = 'tracking_history';

    protected $fillable = [
        'pengiriman_id', 'waktu', 'keterangan', 'lokasi', 'is_done', 'is_current',
    ];

    protected $casts = [
        'waktu'      => 'datetime',
        'is_done'    => 'boolean',
        'is_current' => 'boolean',
    ];

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class);
    }
}
