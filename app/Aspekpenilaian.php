<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aspekpenilaian extends Model
{
    protected $table = 'aspek_penilaian';
    protected $primaryKey ='id_aspek_penilaian';
    protected $fillable = ['nama'];
}
