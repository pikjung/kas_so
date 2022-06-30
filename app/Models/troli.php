<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class troli extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id','type','reference_id','nama_produk','qty','user_id'];

    public function brand()
    {
        return $this->belongsTo(brand::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
