<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembagian_shu extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shu()
    {
        return $this->belongsTo(shu::class);
    }
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
        ->format('Y');
    }
}
