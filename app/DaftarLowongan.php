<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarLowongan extends Model
{
    protected $table = 'daftar_lowongan';
    protected $primaryKey = 'id_daftar_lowongan';
    protected $guarded = [];
}
