<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentasi extends Model
{
    protected $guarded = [];
    protected $table = 'jadwal_presentasi';
    protected $primaryKey = 'id_jadwal_presentasi';

    public function periode(){
        return $this->belongsTo('App\Periode', 'id_periode');
    }
    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'id_kelompok');
    }
    public function dosen(){
        return $this->belongsTo('App\Dosen', 'id_dosen');
    }
    public function ruang(){
        return $this->belongsTo('App\Ruang', 'id_ruang');
    }
    public function sesi(){
        return $this->belongsTo('App\Sesiwaktu', 'id_sesiwaktu');
    }
    
}
