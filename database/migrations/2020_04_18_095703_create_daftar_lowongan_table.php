<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_lowongan', function (Blueprint $table) {
            $table->increments('id_daftar_lowongan');
            $table->integer('id_kelompok')->unsigned();
            $table->integer('id_lowongan')->unsigned();
            $table->date('tanggal_daftar');
            $table->enum('status', ['diterima', 'ditolak']);
            $table->timestamps();

            $table->foreign('id_kelompok')->references('id_kelompok')->on('kelompok');
            $table->foreign('id_lowongan')->references('id_lowongan')->on('lowongan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
