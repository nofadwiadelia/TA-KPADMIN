<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    protected $guarded = [];
    

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }
}
