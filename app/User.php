<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $guarded = [];

    protected $primaryKey ='id_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_lengkap', 'username', 'password', 'id_roles',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function mahasiswa(){
        return $this->hasOne('App\Mahasiswa', 'id_users');
    }
    public function dosen(){
        return $this->hasOne('App\Dosen', 'id_users');
    }
    public function instansi(){
        return $this->hasOne('App\Instansi', 'id_users');
    }

}
