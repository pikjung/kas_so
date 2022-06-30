<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $fillable = ['project_id','nama_brand','singkatan','warna','photo'];

    public function project()
    {
        return $this->belongsTo(project::class);
    }

    public function produk()
    {
        return $this->hasMany(produk::class);
    }

    public function fast_move()
    {
        return $this->hasMany(fast_move::class);
    }

    public function paket()
    {
        return $this->hasMany(paket::class);
    }

    public function troli()
    {
        return $this->hasMany(troli::class);
    }

    public function order()
    {
        return $this->hasMany(order::class);
    }
    
}
