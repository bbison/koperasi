<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    
    public function model(array $row)
    {
        return new User([
            'id'=>$row[0],
            'kode'=>$row[1],
            'name'=>$row[2],
            'bagian'=>$row[3],
            'simpanan_wajib'=>$row[4],
            'simpanan_sukarela'=>$row[5],
            'hak_akses'=>$row[6]
        ]);
    }
}
