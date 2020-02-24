<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $guarded = [];
    protected $table = 'periode';
    protected $primaryKey = 'id';

    public function lowongan(){
        return $this->hasMany('App\Lowongan', 'instansi_id');
    }
}
