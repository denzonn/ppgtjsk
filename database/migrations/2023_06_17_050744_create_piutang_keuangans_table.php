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
        Schema::create('piutang_keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->string('jumlah');
            $table->enum('status', ['Lunas', 'Belum Lunas']);
            $table->longText('catatan')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('piutang_keuangans');
    }
};
