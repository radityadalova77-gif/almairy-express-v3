<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoice', function (Blueprint $table) {

            // drop foreign key lama
            $table->dropForeign(['pelanggan_id']);

            // ubah jadi nullable
            $table->unsignedBigInteger('pelanggan_id')->nullable()->change();

            // buat ulang foreign key
            $table->foreign('pelanggan_id')
                ->references('id')
                ->on('pelanggan')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('invoice', function (Blueprint $table) {

            $table->dropForeign(['pelanggan_id']);

            $table->unsignedBigInteger('pelanggan_id')->nullable(false)->change();

            $table->foreign('pelanggan_id')
                ->references('id')
                ->on('pelanggan');
        });
    }
};
