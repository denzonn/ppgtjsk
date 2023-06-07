<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_bidangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anggota');
            $table->string('foto');
            $table->foreignId('jabatans_id')->constrained('jabatan_bidangs')->onDelete('cascade');
            $table->foreignId('bidangs_id')->constrained('bidangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota_bidangs');
    }
};
