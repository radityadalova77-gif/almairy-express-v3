<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('armada', function (Blueprint $table) {
            $table->id();
            $table->string('no_plat', 20)->unique();
            $table->string('jenis_kendaraan', 100);
            $table->string('kapasitas', 50);
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->nullOnDelete();
            $table->enum('status', ['aktif', 'standby', 'servis', 'nonaktif'])->default('standby');
            $table->integer('km_terakhir')->default(0);
            $table->date('tanggal_servis_berikutnya')->nullable();
            $table->string('merk', 100)->nullable();
            $table->year('tahun')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('armada');
    }
};
