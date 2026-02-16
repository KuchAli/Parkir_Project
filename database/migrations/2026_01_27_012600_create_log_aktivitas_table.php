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
        Schema::create('log_aktivitas', function (Blueprint $table) {
             $table->bigIncrements('id_log')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('aktivitas', 100);
            $table->dateTime('waktu_aktivitas');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
