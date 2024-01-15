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
        Schema::create('data_anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->longText('alamat');
            $table->string('jenis_kelamin');
            $table->string('golongan_darah');
            $table->string('rhesus');
            $table->string('bersedia');
            $table->string('status');
            $table->string('keanggotaan');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('domisili');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('keterangan_tinggal');
            $table->string('wilayah');
            $table->string('keterangan_anggota')->nullable();
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
        Schema::dropIfExists('data_anggotas');
    }
};
