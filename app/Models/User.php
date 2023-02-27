<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->format('d M Y');
    }
    public function simpanan()
    {
        return $this->hasMany(simpanan::class);
    }
    public function simpananWajib()
    {
        return $this->hasMany(simpanan_Wajib::class);
    }
    public function pinjaman()
    {
        return $this->hasMany(pinjaman::class);
    }
    public function angsuran()
    {
        return $this->hasMany(angsuran::class);
    }
    public function angsuranTerbayarDanBelumBagi()
    {
        return $this->hasMany(angsuran::class)->where('status','Sudah Bayar')->where('bagi_shu', 'Belum Dibagi');
    }
    public function pembagian_shu()
    {
        return $this->hasMany(pembagian_shu::class);
    }

}
