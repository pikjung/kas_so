<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skema extends Model
{
    use HasFactory;

    protected $fillable = ['fast_move_detail_id','nama_skema'];

    public function fast_move_detail()
    {
        return $this->belongsTo(skema::class);
    }

    public function skema_detail()
    {
        return $this->hasMany(skema_detail::class);
    }
}
