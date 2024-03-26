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
        Schema::create('detail_nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nilai');
            $table->integer('id_mapel');
            $table->integer('nilai_rl');
            $table->integer('nilai_tp');
            $table->integer('nilai_as');
            $table->integer('k_izin');
            $table->integer('k_sakit');
            $table->integer('k_tanpa_ket');
            $table->text('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_nilai');
    }
};
