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
        return $this->hasOne('App\Dosen', 'id_dosen');
    }
}
