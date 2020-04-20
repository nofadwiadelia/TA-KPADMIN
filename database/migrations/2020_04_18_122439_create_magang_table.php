<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magang', function (Blueprint $table) {
            $table->increments('id_magang');
            $table->integer('id_kelompok')->unsigned();
            $table->integer('id_instansi')->unsigned();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('jobdesk');
            $table->enum('status', ['magang', 'selesai']);
            $table->timestamps();

            $table->foreign('id_kelompok')->references('id_kelompok')->on('kelompok');
            $table->foreign('id_instansi')->references('id_instansi')->on('instansi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magang');
    }
}
