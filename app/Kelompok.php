<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompok';
    protected $primaryKey = 'id_kelompok';
    protected $guarded = [];

    public function mahasiswa(){
        return $this->hasMany('App\Mahasiswa', 'id_mahasiswa');
    }

    public function dosen(){
        return $this->belongsTo('App\Dosen', 'id_dosen');
    }

    public function presentasi(){
        return $this->hasOne('App\Presentasi', 'id_kelompok');
    }

    public function usulan(){
        return $this->hasMany('App\Usulan', 'id_kelompok');
    }
}
