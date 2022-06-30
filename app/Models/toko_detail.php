<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko_detail extends Model
{
    use HasFactory;

    protected $fillable = ['toko_id','area_id'];

    public function toko()
    {
        return $this->belongsTo(toko::class);
    }

    public function area()
    {
        return $this->belongsTo(area::class);
    }
}
