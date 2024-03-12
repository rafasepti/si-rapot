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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn',20);
            $table->integer('id_kelas');
            $table->string('nama_siswa',100);
            $table->string('tempat_lahir',100);
            $table->date('tgl_lahir');
            $table->string('jk',30);
            $table->string('agama',20);
            $table->string('pendidikan_sebelum',20);
            $table->text('alamat_siswa');
            $table->integer('thn_angkatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
