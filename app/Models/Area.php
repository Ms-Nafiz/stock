<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function building()
    {
        return $this->hasMany(Building::class, 'area_id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'area_id');
    }
}
