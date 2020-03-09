<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'id_lowongan';
    protected $guarded = [];
    

    public function instansi(){
        return $this->belongsTo('App\Instansi', 'id_instansi');
    }
    public function periode(){
        return $this->belongsTo('App\Periode', 'id_periode');
    }
}
