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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->integer('nuptk');
            $table->string('kode_guru',20);
            $table->integer('id_mapel');
            $table->string('walikelas',5);
            $table->string('nama_guru',100);
            $table->string('email',100);
            $table->string('password',255);
            $table->text('alamat_guru');
            $table->string('no_telp',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
