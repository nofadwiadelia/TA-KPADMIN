<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelompokPenilai extends Model
{
    protected $table = 'kelompok_penilai';
    protected $primaryKey ='id_kelompok_penilai';
    protected $fillable = ['nama', 'presentase'];
}
