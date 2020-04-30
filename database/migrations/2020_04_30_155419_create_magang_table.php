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
                $table->integer('id_periode')->unsigned();
                $table->date('tanggal_mulai')->nullable();
                $table->date('tanggal_selesai')->nullable();
                $table->text('jobdesk');
                $table->enum('status', ['belum magang','magang', 'selesai'])->default('belum magang');
                $table->timestamps();
    
                $table->foreign('id_kelompok')->references('id_kelompok')->on('kelompok');
                $table->foreign('id_instansi')->references('id_instansi')->on('instansi');
                $table->foreign('id_periode')->references('id_periode')->on('periode');
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
