<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = "fasilitas";

    /**
     * select * from `beasiswa` inner join `FasilitasBeasiswa` on `beasiswa`.`id` = `FasilitasBeasiswa`.`id_beasiswa` where `FasilitasBeasiswa`.`id_fasilitas` = <id>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function beasiswa(){
        return $this->belongsToMany('App\Beasiswa','FasilitasBeasiswa','id_fasilitas','id_beasiswa')
            ->withPivot('keterangan')
            ->withTimestamps();
    }
}
