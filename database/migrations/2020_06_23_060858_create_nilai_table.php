<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->increments('id_nilai');
            $table->integer('id_periode')->unsigned();
            $table->integer('id_mahasiswa')->unsigned();
            $table->integer('id_aspek_penilaian')->unsigned();
            $table->integer('id_kelompok_penilai')->unsigned();
            $table->float('nilai');
            $table->tinyInteger('isDeleted');
            $table->integer('created_by')->unsigned();
            $table->timestamps();

            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_aspek_penilaian')->references('id_aspek_penilaian')->on('aspek_penilaian')->onDelete('cascade');
            $table->foreign('id_kelompok_penilai')->references('id_kelompok_penilai')->on('kelompok_penilai')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}
