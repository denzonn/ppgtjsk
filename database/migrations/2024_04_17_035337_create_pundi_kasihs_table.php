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
        Schema::create('pundi_kasihs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->constrained('nama_banks')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_rek')->nullable();
            $table->string('atas_nama')->nullable();
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
        Schema::dropIfExists('pundi_kasihs');
    }
};
