<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = "persyaratan";

    /**
     * select * from `beasiswa` inner join `PersyaratanBeasiswa` on `beasiswa`.`id` = `PersyaratanBeasiswa`.`id_beasiswa` where `PersyaratanBeasiswa`.`id_persyaratan` = <id>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function beasiswa(){
        return $this->belongsToMany('App\Beasiswa','PersyaratanBeasiswa','id_persyaratan','id_beasiswa')
            ->withPivot('keterangan')
            ->withTimestamps();
    }
}
