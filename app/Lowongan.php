<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'id';
    protected $guarded = [];
    

    public function instansi(){
        return $this->belongsTo('App\Instansi', 'id');
    }
    public function periode(){
        return $this->belongsTo('App\Periode', 'id');
    }
}
