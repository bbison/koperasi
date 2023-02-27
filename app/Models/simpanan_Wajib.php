<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class simpanan_Wajib extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->format('d M Y');
    }
}
