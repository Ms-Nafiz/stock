<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;
    protected $fillable = ['types','stock_impact','is_available'];

    public function transaction(){
        return $this->hasMany(Transaction::class, 'transaction_types');
    }
}
