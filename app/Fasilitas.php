<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = "fasilitas";

    public function beasiswa(){
        return $this->belongsToMany('App\Beasiswa','FasilitasBeasiswa','id_fasilitas','id_beasiswa')
            ->withPivot('keterangan')
            ->withTimestamps();
    }
}
