<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $guarded = [];
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
}
