<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;

    protected  $fillable = ['user_id','area_id'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function area()
    {
        return $this->belongsTo(area::class);
    }
}
