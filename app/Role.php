<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey ='id_roles';
    protected $fillable = ['roles'];
    protected $guarded = [];
}
