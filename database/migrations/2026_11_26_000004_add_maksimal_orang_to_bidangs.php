<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bidangs', function (Blueprint $table) {
            $table->unsignedInteger('maksimal_orang')->nullable();
        });
    }

    public function down()
    {
        Schema::table('bidangs', function (Blueprint $table) {
            $table->dropColumn('maksimal_orang');
        });
    }
};
