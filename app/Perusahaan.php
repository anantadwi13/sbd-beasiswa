<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = "perusahaan";

    /**
     * select * from `beasiswa` where `beasiswa`.`id_perusahaan` = <id>
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beasiswa(){
        return $this->hasMany('App\Beasiswa','id_perusahaan','id');
    }
}
