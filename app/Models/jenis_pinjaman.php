<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pinjaman extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function pinjaman()
    {
        return $this->hasMany(pinjaman::class);
    }
}
