<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class terima_hasil extends Model
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

}
