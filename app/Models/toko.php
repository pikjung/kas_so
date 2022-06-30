<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','kode_toko','nama_toko','region_id'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function region()
    {
        return $this->belongsTo(region::class);
    }

    public function toko_detail()
    {
        return $this->hasMany(toko_detail::class);
    }
}
