<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_perusahaan');
            $table->string('nama',100);
            $table->text('deskripsi')->nullable();
            $table->dateTime('tgl_dibuka')->nullable();
            $table->dateTime('tgl_ditutup')->nullable();
            $table->text('info_tambahan')->nullable();
            $table->timestamps();

            $table->foreign('id_perusahaan')->references('id')->on('perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beasiswa');
    }
}
