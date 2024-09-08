<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\STb;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HandleStb extends Controller
{
    public function findStb($id)
    {
        $transaction = Transaction::with('stb', 'technician', 'transactionType')->where('complain_id', $id)->first();
        $data = [
            'nuid' => $transaction->stb->nuid,
            'technicain' => $transaction->technician->name,
            'complain' => $transaction->transactionType->types
        ];

        if (!$transaction) {
            return response()->json(['error' => 'complain not found'], 404);
        }
        return response()->json($data);
    }
}
