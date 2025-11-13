<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama');
            $table->string('npp')->nullable(); // ubah dari nip → npp
            $table->string('jabatan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('satuan_kerja')->nullable();
            $table->string('judul');
            $table->string('materi')->nullable();
            $table->string('narasumber')->nullable();
            $table->string('jam_pembelajaran')->nullable();
            $table->text('ringkasan')->nullable();
            $table->text('catatan')->nullable();
            $table->text('saran')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
