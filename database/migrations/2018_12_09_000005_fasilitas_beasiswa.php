<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FasilitasBeasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FasilitasBeasiswa', function (Blueprint $table) {
            $table->unsignedInteger('id_beasiswa');
            $table->unsignedInteger('id_fasilitas');
            $table->text('keterangan');
            $table->timestamps();

            $table->primary(['id_beasiswa','id_fasilitas']);
            $table->foreign('id_beasiswa')->references('id')->on('beasiswa')->onDelete('cascade');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FasilitasBeasiswa');
    }
}
