<?php

namespace App\Imports;

use App\Models\pinjaman;
use Maatwebsite\Excel\Concerns\ToModel;

class pinjamanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new pinjaman([
            'user_id'=>$row[1],
            'kode'=>$row[0],
            'bunga_pinjaman_id'=>$row[4],
            'angsuran_belum_terbayar'=>$row[2],
            'status_pinjaman'=>$row[3],
            'total_angsuran'=>$row[4],
            'lama_pinjam'=>$row[5],
            'jenis_pinjaman_id'=>$row[6],
        ]);
    }
}
