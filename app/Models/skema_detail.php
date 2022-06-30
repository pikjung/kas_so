<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skema_detail extends Model
{
    use HasFactory;

    protected $fillable = ['skema_id','detail'];

    public function skema()
    {
        return $this->belongsTo(skema::class);
    }
}
