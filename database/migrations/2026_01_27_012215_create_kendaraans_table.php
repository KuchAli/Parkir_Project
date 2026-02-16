<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {
           $table->bigIncrements('id_kendaraan')->primary();
            $table->string('plat_nomor', 15);
            $table->string('jenis_kendaraan', 20);
            $table->string('warna', 20);
            $table->string('pemilik', 100);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
