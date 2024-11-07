<?php

namespace App\Livewire;

use App\Models\STb;
use Livewire\Component;
use App\Models\Building;
use App\Models\Technician;
use App\Models\Transaction;
use App\Traits\StockHandler;
use App\Models\TransactionType;
use LivewireUI\Modal\ModalComponent;

class TransactionEdit extends ModalComponent
{
    use StockHandler;
    public $id;
    public $address;
    public $note;
    public $complainId;
    public $types;
    public $technician;
    public $building;
    public $nuid;
    public $exchangeFor;
    public function render()
    {
        $availableTech = Technician::where('is_active', true)->get();
        $availableTypes = TransactionType::where('is_available', true)->get();
        $allBuildings = Building::all();
        return view('livewire.transaction-edit', compact('availableTech', 'availableTypes', 'allBuildings'));
    }

    public function mount()
    {
        $transId = $this->id;
        $stb = Transaction::with(['stb', 'notes' => function ($q) use ($transId) {
            $q->where('transactions_id', $transId)->first();
        }])->find($this->id);
        $this->address = $stb->address;
        $this->technician = $stb->technician_id;
        $this->types = $stb->transaction_type_id;
        $this->building = $stb->building_id;
        $this->complainId = $stb->complain_id;
        $this->exchangeFor = $stb->exchange_for;
        $this->note = $stb->notes->count() > 0 ? $stb->notes[0]->note : null;
        $this->nuid = $stb->stb->nuid;
    }

    public function editTransaction()
    {
        $transId = $this->id;
        $stbId = STb::where('nuid', $this->nuid)->first()->id;
        // dd($stbId);
        $stb = Transaction::with(['stb', 'notes' => function ($q) use ($transId) {
            $q->where('transactions_id', $transId)->first();
        }])->find($this->id);
        $stb->address = $this->address;
        $stb->technician_id = $this->technician;
        $stb->transaction_type_id = $this->types;
        $stb->building_id = $this->building;
        $stb->complain_id = $this->complainId;
        $stb->exchange_for = $this->exchangeFor;

        // stock update
        $this->updateStockUpdate($this->types, $this->nuid, $this->exchangeFor);

        // Update the note if it exists
        if ($this->note) {
            $note = $stb->notes->first(); // Assuming you want to update the first note
            if ($note) {
                $note->note = $this->note;
                $note->transactions_id = $this->id; // Ensure the note is linked to this transaction
                $note->save(); // Save the updated note
            } else {
                // Optionally handle the case where there are no notes
                // You might want to create a new note here
            }
        }
        $stb->save();
        $msg = 'Update Successful!';
        $this->dispatch('newTransaction',$msg);
        $this->closeModal();
    }
}
