<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey ='id_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_lengkap', 'username', 'password', 'roles_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function mahasiswa(){
        return $this->hasOne('App\Mahasiswa', 'users_id');
    }
    public function dosen(){
        return $this->hasMany('App\Dosen', 'users_id');
    }
    public function instansi(){
        return $this->hasMany('App\Instansi', 'users_id');
    }

}
