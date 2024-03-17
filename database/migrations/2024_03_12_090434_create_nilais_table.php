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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->integer('semester');
            $table->integer('id_thn_ajaran');
            $table->string('nilai_sikap',20);
            $table->string('nilai_kerajinan',20);
            $table->string('nilai_kebersihan',20);
            $table->integer('kehadiran_izin');
            $table->integer('kehadiran_sakit');
            $table->integer('kehadiran_tanpa_ket');
            $table->date('tgl_penilaian');
            $table->text('catatan');
            $table->string('naik_kelas',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
