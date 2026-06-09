<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    protected $fillable = [
        'no_invoice',
        'pelanggan_id',
        'pengiriman_id', // ⚠️ tetap dipertahankan (legacy)
        'nominal',
        'tanggal_invoice',
        'jatuh_tempo',
        'status',
        'catatan'
    ];

    protected $casts = [
        'tanggal_invoice' => 'date',
        'jatuh_tempo' => 'date',
    ];

    /*
    |--------------------------------------------------
    | RELATION
    |--------------------------------------------------
    */

    // ✅ RELASI LAMA (BIAR GA ERROR)
    public function pengiriman()
    {
        return $this->belongsToMany(
            \App\Models\Pengiriman::class,
            'invoice_pengiriman',
            'invoice_id',
            'pengiriman_id'
        );
    }

    // ✅ RELASI BARU (MULTI PENGIRIMAN)
    public function pengirimans()
    {
        return $this->belongsToMany(Pengiriman::class, 'invoice_pengiriman');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /*
    |--------------------------------------------------
    | HELPER
    |--------------------------------------------------
    */

    public static function generateNomor()
    {
        $prefix = 'INV-' . date('Ymd');

        $last = self::where('no_invoice', 'like', $prefix . '%')
            ->orderByDesc('no_invoice')
            ->first();

        if (!$last) {
            return $prefix . '-001';
        }

        $lastNumber = (int) substr($last->no_invoice, -3);
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return $prefix . '-' . $newNumber;
    }

    public function getTotalAttribute()
    {
        return $this->pengirimans->sum(function ($p) {
            return ($p->tarif ?? 0) * ($p->kg ?? 0);
        });
    }
}
