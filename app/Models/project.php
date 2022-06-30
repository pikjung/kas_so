<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    protected $fillable = ['nama_project'];

    public function area()
    {
        return $this->hasMany(area::class);
    }

    public function brand()
    {
        return $this->hasMany(brand::class);
    }
}
