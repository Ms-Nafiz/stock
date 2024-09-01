<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $fillable = ['name','area_id'];

    public function area(){
        return $this->belongsTo(Area::class, 'area_id','id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'building_id');
    }
}
