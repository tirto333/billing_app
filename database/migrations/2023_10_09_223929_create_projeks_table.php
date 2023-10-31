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
        Schema::create('projeks', function (Blueprint $table) {
            $table->id();
            $table->string('no_spk', 50)->nullable();
            $table->string('judul_projek', 50)->nullable();
            $table->string('jenis_projek', 50)->nullable();
            $table->string('detail_jprojek', 50)->nullable();
            $table->string('lingkup_projek', 50)->nullable();
            $table->string('pelanggan', 50)->nullable();
            $table->string('nama_anggota', 50)->nullable();
            $table->string('deskripsi_projek', 500)->nullable();
            $table->string('prioritas', 10)->nullable();
            $table->string('status_projek', 10)->nullable();
            $table->date('tengat_waktu');
            $table->string('dibuat_oleh', 10)->nullable();
            $table->string('kepala_projek', 500)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projeks');
    }
};
