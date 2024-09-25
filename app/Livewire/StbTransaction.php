<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\STb;
use Livewire\Component;
use App\Models\Transaction;
use App\Traits\ApiCallHandle;
use App\Traits\StockHandler;

class StbTransaction extends Component
{
    use ApiCallHandle;
    use StockHandler;
    public $stbTransaction, $results, $msg, $nuid;
    public $formDate;
    public $toDate;
    public $statusMsg;
    public $deleteMsg;
    public $transactionsDetails;
    public $test;
    protected $listeners = ['updateTransaction' => 'updateTransaction', 'newTransaction' => 'updateTransaction'];

    public function render()
    {
        return view('livewire.stb-transaction');
    }

    public function mount()
    {
        $this->stbTransaction = $this->mergedApiData($this->transactionHistory()->get());
        
    }

    public function search()
    {
        // dd($this->callApi($this->transactionHistory()->pluck('complain_id')->toArray()));
        // dd($this->callApi($this->transactionHistory()->pluck('complain_id'))->toArray());
        // find signle stb for add transaction
        $this->deleteMsg = null;
        $this->results = null;
        $this->msg = null;
        $findResult = STb::with('transaction')->where('nuid', $this->nuid)->first();
        if ($findResult) {
            $this->results = $findResult;
        } else {
            $this->msg = 'STB is out of stock or wrong nuid!';
        }
        $this->stbTransaction = $this->mergedApiData($this->transactionHistory()->get());
        $this->transactionsDetails = $this->stbTransactions();
    }

    public function statusUpdate($id)
    {
        $findStb = STb::find($id);
        if ($findStb->status == 'good') {
            $findStb->status = 'error';
        } else {
            $findStb->status = 'good';
        }
        $findStb->save();
        $this->search();
        $this->statusMsg = 'Stb Status Updated!';
    }
    public function updateTransaction()
    {
        // this will update transaction after added new transaction
        $this->stbTransaction = $this->mergedApiData($this->transactionHistory()->get());
    }
    public function transactionHistory()
    {
        // current month transaction history
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        return Transaction::with(['stb', 'transactionType', 'technician', 'area', 'building', 'notes' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->orderBy('created_at', 'desc');
    }

    public function findTransaction()
    {
        // find transaction based on seleted two dates
        $transactionByDates = Transaction::with(['stb', 'transactionType', 'technician', 'area', 'building', 'notes' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])
            ->whereBetween('created_at', [$this->formDate, $this->toDate])
            ->orderBy('created_at', 'desc')
            ->get();
        $this->stbTransaction = $this->mergedApiData($transactionByDates);
    }
    public function addStb()
    {
        // if the stb no found it will add the stb after pressing add button
        $this->msg = null;
        $addStb = new STb();
        $addStb->nuid = $this->nuid;
        $addStb->category = $this->stbCategory($this->nuid);
        $addStb->is_stock = true;
        $addStb->remarks = 'first upload' . ', ' . date('d-m-Y');
        $addStb->save();
        $this->search();
    }

    public function deleteTransaction($id)
    {
        // before delete find stb and restore previous stock status then deleted
        $transaction = Transaction::with('stb')->find($id);
        $transaction->stb->is_stock = !$transaction->stb->is_stock;
        $transaction->stb->save();

        $transaction->delete();

        $this->deleteMsg = 'Transaction has been deleted!';
        // update new transaction data
        $this->stbTransaction = $this->mergedApiData($this->transactionHistory()->get());
    }
    public function stbTransactions(){
        return STb::with('transaction')->where('nuid', $this->nuid)->get();
    }
}
