<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class STb extends Model
{
    use HasFactory;
    protected $fillable = ['nuid','bcl_id','category','status','is_stock','remarks'];

    public function transaction(){
        return $this->hasMany(Transaction::class, 'stb_id');
    }
}
