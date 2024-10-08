<?php

namespace App\Traits;

use App\Models\STb;
use App\Models\TransactionType;

trait StockHandler
{
    public function updateStockUpdate($type, $nuid, $exchangeFor)
    {
        $impact = TransactionType::find($type);

        $stb = STb::where('nuid', $nuid)->first();
        if ($impact->types == 'Exchange') {
            $findStb = STb::where('nuid', $exchangeFor)->first();
            $findStb->is_stock = true;
            $findStb->save();
            $stb->is_stock = false;
            $stb->save();
            return;
        }
        $stb->is_stock = $impact->stock_impact;
        $stb->save();
    }

    public function stbCategory($nuid)
    {
        $firstDigit = substr($nuid, 0, 1);
        $category = null;

        if ($firstDigit == 2) {
            $category = 'NL';
        } elseif ($firstDigit == 3) {
            $category = 'HC';
        } else {
            $category = "NSTV";
        }

        return $category;
    }
}
