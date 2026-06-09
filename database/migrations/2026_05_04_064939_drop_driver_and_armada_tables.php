<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // MATIKAN FK CHECK (biar gak rewel)
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('armada');
        Schema::dropIfExists('drivers');

        // AKTIFKAN LAGI
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        //
    }
};
