<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id','kode_idem','nama_produk','deskripsi','aktif'];

    public function brand()
    {
            return $this->belongsTo(brand::class);
    }
}
