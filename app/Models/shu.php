<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shu extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->format('Y');
    }
    public function pembagian_shu()
    {
        return $this->hasMany(pembagian_shu::class);
    }
}
