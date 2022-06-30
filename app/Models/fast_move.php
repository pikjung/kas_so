<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fast_move extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id','nama_fast_move','aktif'];

    public function fast_move_detail()
    {
        return $this->hasMany(fast_move_detail::class);
    }

    public function brand()
    {
        return  $this->belongsTo(brand::class);
    }
}
