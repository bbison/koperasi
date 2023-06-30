<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class journal extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function rincian_journal()
    {
        return $this->hasMany(rincian_journal::class);
    }
    public function akun()
    {
        return $this->belongsTo(akun::class);
    }
}
