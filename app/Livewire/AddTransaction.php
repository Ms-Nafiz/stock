<?php

namespace App\Livewire;

use PDO;
use App\Models\STb;
use App\Models\Note;
use Livewire\Component;
use App\Models\Building;
use App\Models\Technician;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Traits\StockHandler;
use LivewireUI\Modal\ModalComponent;

class AddTransaction extends ModalComponent
{
    use StockHandler;
    public $address;
    public $note;
    public $complainId;
    public $types;
    public $technician;
    public $building;
    public $id;
    public $nuid;
    public $exchangeFor;
    protected $rules = [
        'address' => 'required|string|max:255',
        'types' => 'required|string',
        'technician' => 'required|string',
        'building' => 'required|string',
    ];

    public function render()
    {
        $availableTech = Technician::where('is_active', true)->get();
        $availableTypes = TransactionType::where('is_available', true)->get();
        $allBuildings = Building::all();
        return view('livewire.add-transaction', compact('availableTech', 'availableTypes', 'allBuildings'));
    }

    public function mount()
    {

        $stbs = STb::find($this->id);
        $this->nuid = $stbs->nuid;
    }
    public function save()
    {
        $this->validate();
        if (strpos(TransactionType::find($this->types)->types, 'Exchange') !== false) {
            $this->validate(
                [
                    'exchangeFor' => 'required'
                ],
                [
                    'exchangeFor.required' => 'Required'
                ]
            );
        }

        // Process the data here, for example, save to the database
        $areaId = Building::with('area')->find($this->building);
        $transaction = new Transaction();
        $transaction->stb_id = STb::find($this->id)->id;
        $transaction->address = $this->address;
        $transaction->complain_id = $this->complainId;
        $transaction->transaction_type_id = $this->types;
        $transaction->technician_id = $this->technician;
        $transaction->building_id = $this->building;
        $transaction->exchange_for = $this->exchangeFor;
        $transaction->area_id = $areaId->area->id;
        $transaction->save();

        $this->updateStockUpdate($this->types, $this->nuid, $this->exchangeFor);

        if ($this->note !== null) {
            $note = new Note();
            $note->note = $this->note;
            $note->transactions_id = $transaction->id;
            $note->save();
        }
        // Optionally, reset form fields after submission
        $this->reset();

        // Add a success message or redirect
        session()->flash('message', 'Transaction added successfully.');
        $this->dispatch('updateTransaction');
    }
}
