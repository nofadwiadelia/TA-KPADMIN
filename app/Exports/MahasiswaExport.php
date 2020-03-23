<?php

namespace App\Exports;

use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
        ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
        ->leftJoin('periode', 'kelompok.id_periode', 'periode.id_periode')
        ->select('mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.angkatan','kelompok.nama_kelompok', 'kelompok_detail.status','periode.tahun_periode')
        ->get();
    }
}
