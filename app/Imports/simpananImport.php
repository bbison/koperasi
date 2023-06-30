<?php

namespace App\Imports;

use App\Models\simpanan;
use Maatwebsite\Excel\Concerns\ToModel;

class simpananImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new simpanan([
            'user_id'=>$row[0] +1,
            'no_simpanan'=>$row[0] +1 ,
            'simpanan_suka_rela'=>$row[5],
            'created_at'=>$row[7],
        ]);
    }
}
