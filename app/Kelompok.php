<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompok';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function mahasiswa(){
        return $this->hasMany('App\Mahasiswa', 'id');
    }

    public function dosen(){
        return $this->hasOne('App\Dosen', 'id');
    }
}
