<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengiriman', function (Blueprint $table) {

            // drop foreign key dulu
            $table->dropForeign(['driver_id']);
            $table->dropForeign(['armada_id']);

            // baru drop kolom
            $table->dropColumn(['driver_id', 'armada_id']);
        });
    }

    public function down(): void
    {
        Schema::table('pengiriman', function (Blueprint $table) {
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('armada_id')->nullable()->constrained()->nullOnDelete();
        });
    }
};
