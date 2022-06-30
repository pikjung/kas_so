<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class region extends Model
{
    use HasFactory;

    protected $fillable = ['nama_region'];

    public function toko()
    {
        return $this->hasMany(toko::class);
    }
}
