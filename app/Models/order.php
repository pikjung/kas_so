<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id','user_id','nama_order','tgl_order','status','note','ordered_by','confirm_by'];

    public function brand()
    {
        return $this->belongsTo(brand::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
