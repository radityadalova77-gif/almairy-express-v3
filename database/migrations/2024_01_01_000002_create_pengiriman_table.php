<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->string('resi', 50)->unique();
            $table->string('jenis_barang', 100)->nullable();
            $table->integer('jumlah_koli')->default(1);
            $table->decimal('berat_kg', 10, 2)->default(0);
            $table->string('nama_pengirim', 100);
            $table->string('hp_pengirim', 20)->nullable();
            $table->string('nama_penerima', 100);
            $table->string('hp_penerima', 20)->nullable();
            $table->string('kota_tujuan', 100);
            $table->enum('pulau_tujuan', ['Jawa', 'Sumatera', 'Kalimantan', 'Sulawesi', 'Bali', 'Papua', 'NTT', 'NTB', 'Maluku'])->default('Jawa');
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->nullOnDelete();
            $table->foreignId('armada_id')->nullable()->constrained('armada')->nullOnDelete();
            $table->enum('status', ['pending', 'gudang', 'transit', 'delivered', 'problem'])->default('pending');
            $table->date('tanggal_kirim');
            $table->date('estimasi_tiba')->nullable();
            $table->decimal('tarif', 15, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
