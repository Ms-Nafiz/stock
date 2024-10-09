<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewConnectionFormat;
use App\Models\STb;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HandleStb extends Controller
{
    public $dataFromApi;
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

    public function formatNewConnectionList(Request $req)
    {
        $apiData = $req->json()->all();

        // $this->saveData($req->all());
        return response()->json([
            'msg' => 'Success',
            'data' => $apiData
        ], 200);
    }

    public function saveData ($data){
        $ncData = new NewConnectionFormat();
        $ncData->data = $data;
        $ncData->save();
    }
}
