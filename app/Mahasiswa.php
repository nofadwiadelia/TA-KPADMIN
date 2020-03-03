<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $guarded = [];
    

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }

    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'mahasiswa_id');
    }

    
}
