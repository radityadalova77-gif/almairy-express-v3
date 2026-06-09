<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ─────────────────────────────────────────
        // TABEL PELANGGAN
        // ─────────────────────────────────────────
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 150);
            $table->string('nama_kontak', 100)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('kota', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            // ✅ TAMBAHAN (PENTING)
            $table->softDeletes();
        });

        // ─────────────────────────────────────────
        // TABEL INVOICE
        // ─────────────────────────────────────────
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice', 30)->unique();

            // ✅ tetap sama (tidak diubah)
            $table->foreignId('pelanggan_id')->constrained('pelanggan');

            $table->foreignId('pengiriman_id')
                ->nullable()
                ->constrained('pengiriman')
                ->nullOnDelete();

            $table->decimal('nominal', 15, 2);
            $table->date('tanggal_invoice');
            $table->date('jatuh_tempo');
            $table->enum('status', ['pending', 'lunas', 'overdue'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // ─────────────────────────────────────────
        // TABEL TRACKING
        // ─────────────────────────────────────────
        Schema::create('tracking_history', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengiriman_id')
                ->constrained('pengiriman')
                ->cascadeOnDelete();

            $table->datetime('waktu');
            $table->string('keterangan', 255);
            $table->string('lokasi', 255)->nullable();
            $table->boolean('is_done')->default(false);
            $table->boolean('is_current')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_history');
        Schema::dropIfExists('invoice');
        Schema::dropIfExists('pelanggan');
    }
};
