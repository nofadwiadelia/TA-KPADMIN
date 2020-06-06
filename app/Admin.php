<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $guarded = [];

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }
}
