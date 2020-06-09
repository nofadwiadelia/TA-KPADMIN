<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'ruang';
    protected $primaryKey ='id_ruang';
    protected $fillable = ['ruang'];

    public function presentasi(){
        return $this->hasMany('App\Presentasi', 'id_ruang');
    }
}
