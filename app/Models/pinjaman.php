<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinjaman extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bunga_pinjaman()
    {
        return $this->belongsTo(bunga_pinjaman::class);
    }
    public function angsuran()
    {
        return $this->hasMany(angsuran::class);
    }
    public function pembagian_shu()
    {
        return $this->hasMany(pembagian_shu::class);
    }
}
