<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = "beasiswa";

    public function perusahaan(){
        return $this->belongsTo('App\Perusahaan','id_perusahaan','id');
    }

    public function persyaratan(){
        return $this->belongsToMany('App\Persyaratan','PersyaratanBeasiswa','id_beasiswa','id_persyaratan')
            ->withPivot('keterangan')
            ->withTimestamps();
    }

    public function fasilitas(){
        return $this->belongsToMany('App\Fasilitas','FasilitasBeasiswa','id_beasiswa','id_fasilitas')
            ->withPivot('keterangan')
            ->withTimestamps();
    }
}
