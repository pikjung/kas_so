<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id','nama_paket','deskripsi','aktif'];

    public function brand()
    {
        return $this->belongsTo(brand::class);
    }
}
