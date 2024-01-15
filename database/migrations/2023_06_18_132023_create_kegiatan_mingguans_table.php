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
        Schema::create('kegiatan_mingguans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade')->onUpdate('cascade');
            $table->time('waktu');
            $table->string('tempat');
            $table->string('maps');
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
        Schema::dropIfExists('kegiatan_mingguans');
    }
};
