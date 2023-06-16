<?php

namespace App\Imports;

use App\Models\simpanan_wajib;
use Maatwebsite\Excel\Concerns\ToModel;

class simpanan_wajibImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new simpanan_wajib([
            'user_id'=>$row[0] + 1,
            'no_simpanan'=>$row[0] + 1,
            'simpanan_wajib'=>$row[4],
        ]);
    }
}
