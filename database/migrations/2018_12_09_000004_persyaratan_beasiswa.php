<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersyaratanBeasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PersyaratanBeasiswa', function (Blueprint $table) {
            $table->unsignedInteger('id_beasiswa');
            $table->unsignedInteger('id_persyaratan');
            $table->text('keterangan');
            $table->timestamps();

            $table->primary(['id_beasiswa','id_persyaratan']);
            $table->foreign('id_beasiswa')->references('id')->on('beasiswa');
            $table->foreign('id_persyaratan')->references('id')->on('persyaratan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PersyaratanBeasiswa');
    }
}
