<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['note','transactions_id'];
    public function transaction(){
        return $this->belongsTo(Transaction::class, 'transactions_id');
    }
}
