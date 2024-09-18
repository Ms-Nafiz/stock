<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\STb;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HandleStb extends Controller
{
    public function findStb()
    {
        $transaction = Transaction::with('stb', 'technician', 'transactionType')->get();

        $data = $transaction->map(function ($stb) {
            return [
                'technician' => $stb->technician->name,
                'nuid' => $stb->stb->nuid,
                'complain' => $stb->transactionType->types,
                'cusId' => $stb->complain_id
            ];
        });
        if (!$transaction) {
            return response()->json(['error' => 'complain not found'], 404);
        }
        return response()->json($data);
    }
}
