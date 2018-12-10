<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = "perusahaan";

    public function beasiswa(){
        return $this->hasMany('App\Beasiswa','id_perusahaan','id');
    }
}
