<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelamar', function (Blueprint $table) {
            $table->increments('id_pelamar');
            $table->integer('id_lowongan')->unsigned();
            $table->integer('id_kelompok')->unsigned();
            $table->date('tanggal_daftar');
            $table->enum('status', ['melamar','diterima', 'ditolak'])->default('melamar');
            $table->integer('created_by')->unsigned();
            $table->tinyInteger('isDeleted')->default('0');
            $table->timestamps();

            $table->foreign('id_kelompok')->references('id_kelompok')->on('kelompok')->onDelete('cascade');
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
        Schema::dropIfExists('pelamar');
    }
}
