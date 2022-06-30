<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fast_move_detail extends Model
{
    use HasFactory;

    protected $fillable = ['fast_move_id','nama_fast_move_detail'];

    public function fast_move()
    {
        return $this->belongsTo(project::class);
    }

    public function skema()
    {
        return $this->hasMany(skema::class);
    }
}
