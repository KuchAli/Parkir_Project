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
        Schema::create('transaksi', function (Blueprint $table) {
           $table->bigInteger('id_parkir')->primary();
            $table->unsignedBigInteger('id_kendaraan');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->unsignedBigInteger('id_tarif');
            $table->integer('durasi_jam')->nullable();
            $table->decimal('biaya_total', 10, 0)->nullable();
            $table->enum('status', ['masuk', 'keluar']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_area');
            $table->timestamps();

            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraan');
            $table->foreign('id_tarif')->references('id_tarif')->on('tarifs');
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('id_area')->references('id_area')->on('area_parkir');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
