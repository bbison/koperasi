<?php

namespace App\Imports;

use App\Models\angsuran;
use Maatwebsite\Excel\Concerns\ToModel;

class angsuranImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new angsuran([
            'id'=>$row[0],
            'pinjaman_id'=>$row[0],
            'user_id'=>$row[0],
            'bunga_angsuran'=>$row[0],
            'tagihan_angsuran'=>$row[0],
            'bulan_angsuran'=>$row[0],
            'status'=>$row[0],
            'bagi_shu'=>$row[0],
            'jatuh_tempo'=>$row[0],
        ]);
    }
}
