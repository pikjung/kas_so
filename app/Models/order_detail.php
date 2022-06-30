<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','type','nama_produk','qty','check','remark'];

    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
