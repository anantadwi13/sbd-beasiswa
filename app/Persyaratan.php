<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = "persyaratan";

    public function beasiswa(){
        return $this->belongsToMany('App\Beasiswa','PersyaratanBeasiswa','id_persyaratan','id_beasiswa')
            ->withPivot('keterangan')
            ->withTimestamps();
    }
}
