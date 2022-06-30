<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;
    protected $fillable = ['project_id','nama_area'];

    public function project()
    {
        return $this->belongsTo(project::class);
    }

    public function sales()
    {
        return $this->hasMany(sales::class);
    }

    public function toko_detail()
    {
        return $this->hasMany(toko_detail::class);
    }
}
