<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = "beasiswa";

    /**
     * select * from `perusahaan` where `perusahaan`.`id` = <id_perusahaan>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function perusahaan(){
        return $this->belongsTo('App\Perusahaan','id_perusahaan','id');
    }

    /**
     * select * from `persyaratan` inner join `PersyaratanBeasiswa` on `persyaratan`.`id` = `PersyaratanBeasiswa`.`id_persyaratan` where `PersyaratanBeasiswa`.`id_beasiswa` = <id>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function persyaratan(){
        return $this->belongsToMany('App\Persyaratan','PersyaratanBeasiswa','id_beasiswa','id_persyaratan')
            ->withPivot('keterangan')
            ->withTimestamps();
    }

    /**
     * select * from `fasilitas` inner join `FasilitasBeasiswa` on `fasilitas`.`id` = `FasilitasBeasiswa`.`id_fasilitas` where `FasilitasBeasiswa`.`id_beasiswa` = <id>
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fasilitas(){
        return $this->belongsToMany('App\Fasilitas','FasilitasBeasiswa','id_beasiswa','id_fasilitas')
            ->withPivot('keterangan')
            ->withTimestamps();
    }
}
