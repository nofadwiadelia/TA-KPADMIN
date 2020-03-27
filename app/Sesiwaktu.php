<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesiwaktu extends Model
{

    protected $table = 'sesiwaktu';
    protected $primaryKey ='id_sesiwaktu';
    protected $fillable = ['sesi'];
}
