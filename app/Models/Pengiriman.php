<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'resi',
        'jenis_barang',
        'jumlah_koli',
        'berat_kg',
        'harga_per_kg',
        'tarif',

        'nama_pengirim',
        'hp_pengirim',
        'nama_penerima',
        'hp_penerima',

        'kota_tujuan',
        'pulau_tujuan',

        'tanggal_kirim',
        'estimasi_tiba',
        'catatan',

        'status',
        'is_deleted',
        'deleted_at',
        'created_by',
        'deleted_by',
    ];

    protected $casts = [
        'tanggal_kirim' => 'date',
        'estimasi_tiba' => 'date',
        'deleted_at' => 'datetime',
        'is_deleted' => 'boolean',
    ];

    // ✅ RELASI TRACKING
    public function trackingHistory()
    {
        return $this->hasMany(TrackingHistory::class, 'pengiriman_id');
    }

    // ✅ RELASI MANY TO MANY
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_pengiriman');
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending'   => 'Menunggu',
            'gudang'    => 'Di Gudang',
            'transit'   => 'Dalam Perjalanan',
            'delivered' => 'Terkirim',
            'problem'   => 'Masalah',
            default     => ucfirst($this->status),
        };
    }

    public function getTarifFormatAttribute()
    {
        return 'Rp ' . number_format($this->tarif ?? 0, 0, ',', '.');
    }

    public static function generateResi()
    {
        $prefix = 'ALM-' . date('Ymd');

        $last = self::where('resi', 'like', $prefix . '%')
            ->orderByDesc('resi')
            ->first();

        if (!$last) return $prefix . '-001';

        $num = (int) substr($last->resi, -3) + 1;

        return $prefix . '-' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
