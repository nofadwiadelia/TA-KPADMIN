<?php

namespace App\Imports;

use App\User;
use App\Instansi;
use App\Role;
use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = new User([
            'username'     => $row['username'],
            // 'slug' => str_slug($row['username']),
            // 'password' => $row['password'],
            'password' => \Hash::make('password'),
            'id_roles'     => $row['id_roles'],
        ]);
        
        $data->save();

        if($row['id_roles'] == 2){
            $data->dosen()->create([
                'nama'     => $row['nama'],
            ]);
        }
        else if($row['id_roles'] == 3){
            $data->instansi()->create([
                'nama'     => $row['nama'],
            ]);
        }
        else if($row['id_roles'] == 4){
            $data->mahasiswa()->create([
                'nama'     => $row['nama'],
                'nim'     => $row['nim'],
                'id_periode'     => $row['id_periode'],
            ]);
        }
    }
}
