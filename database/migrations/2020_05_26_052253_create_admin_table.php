<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id_admin');
            $table->integer('id_users')->unsigned();
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->text('foto')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
