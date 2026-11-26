<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('periode_id')->nullable()->constrained('periodes')->nullOnDelete();
            $table->boolean('per_periode')->default(false);
            $table->enum('aksi', ['tambah', 'ubah', 'hapus']);
            $table->string('model');
            $table->unsignedBigInteger('model_id');
            $table->json('sebelum')->nullable();
            $table->json('sesudah')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->index(['model', 'model_id']);
        });

        Schema::table('inventaris', function (Blueprint $table) {
            $table->foreignId('periode_id')->nullable()->constrained('periodes')->nullOnDelete();
        });

        $id = DB::table('periodes')->where(['tahun_mulai' => 2024, 'tahun_selesai' => 2026])->value('id');
        DB::table('inventaris')->update(['periode_id' => $id]);
    }

    public function down()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->dropConstrainedForeignId('periode_id');
        });
        Schema::dropIfExists('activity_logs');
    }
};
