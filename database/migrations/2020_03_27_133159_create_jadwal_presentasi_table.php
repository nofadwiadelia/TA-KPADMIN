<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalPresentasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_presentasi', function (Blueprint $table) {
            $table->increments('id_jadwal_presentasi');
            $table->integer('id_kelompok')->unsigned();
            $table->integer('id_periode')->unsigned();
            $table->integer('id_dosen')->unsigned();
            $table->integer('id_sesiwaktu')->unsigned();
            $table->integer('id_ruang')->unsigned();
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_periode')->references('id_periode')->on('periode');
            $table->foreign('id_kelompok')->references('id_kelompok')->on('kelompok');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
            $table->foreign('id_sesiwaktu')->references('id_sesiwaktu')->on('sesiwaktu');
            $table->foreign('id_ruang')->references('id_ruang')->on('ruang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_presentasi');
    }
}
