<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['address','complain_id','transaction_type_id','area_id','building_id','stb_id','technician_id','exchange_for'];

    public function stb()
    {
        return $this->belongsTo(STb::class, 'stb_id', 'id');
    }
    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id', 'id');
    }
    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id', 'id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'transactions_id');
    }
}
