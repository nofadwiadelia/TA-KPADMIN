<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $primaryKey = 'id';
    protected $guarded = [];
    

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }
}
