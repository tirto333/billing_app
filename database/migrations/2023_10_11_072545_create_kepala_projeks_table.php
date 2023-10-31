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
        Schema::create('kepala_projeks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_projek');
            $table->string('nm_anggota', 500)->nullable();
            $table->string('posisi', 50)->nullable();
            $table->string('divisi', 50)->nullable();
            $table->string('dibuat_oleh', 10)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_projeks');
    }
};
