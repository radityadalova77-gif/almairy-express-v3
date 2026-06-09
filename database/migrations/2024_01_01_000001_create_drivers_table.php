<?php
// Migration: drivers
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('no_hp', 20);
            $table->string('no_lisensi', 50)->nullable();
            $table->enum('jenis_sim', ['SIM A', 'SIM B1', 'SIM B2', 'SIM B2 Umum'])->default('SIM B2 Umum');
            $table->string('rute_aktif', 200)->nullable();
            $table->integer('total_trip')->default(0);
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->enum('status', ['aktif', 'libur', 'nonaktif'])->default('aktif');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
