<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\Building;
use App\Models\TransactionType;
use Livewire\Component;

class AreaHandle extends Component
{
    public $areaList, $transactionType, $areaMsg;
    public $areaName;
    public $parentArea, $buildingName, $buildingMsg;
    public $type, $typeMsg, $stockImpact;
    public function render()
    {
        return view('livewire.area-handle');
    }

    public function mount()
    {
        $this->areaList = Area::with('building')->get();
        $this->transactionType = TransactionType::all();
    }

    public function addArea()
    {
        $this->buildingMsg = null;
        $area = Area::where('name', $this->areaName)->get();
        if ($area->count() > 0) {
            $this->areaMsg = 'This area name already has been added!';
        } else {
            $addArea = new Area();
            $addArea->name = $this->areaName;
            $addArea->save();
            $this->areaMsg = 'Area successfully added!';
        }
        $this->reset('areaName');
        $this->areaList = Area::all();
    }

    public function addBuilding()
    {
        $this->areaMsg = null;
        $building = Building::where('name', $this->buildingName)->get();
        if ($building->count() > 0) {
            $this->buildingMsg = 'This building name already has been added!';
        } else {
            $addBuilding = new Building();
            $addBuilding->name = $this->buildingName;
            $addBuilding->area_id = $this->parentArea;
            $addBuilding->save();
            $this->buildingMsg = 'Building successfully added!';
        }
        $this->reset('buildingName');
        $this->areaList = Area::all();
    }

    public function addTransactionType()
    {
        $isDuplicate = TransactionType::where('types', $this->type)->get();
        if ($isDuplicate->count() > 0) {
            $this->typeMsg = 'This type name already has been added!';
        } else {
            $newTypes = new TransactionType();
            $newTypes->types = $this->type;
            $newTypes->stock_impact = $this->stockImpact;
            $newTypes->save();
            $this->typeMsg = 'Type added successful!';
        }
        $this->reset('type', 'stockImpact');
        $this->transactionType = TransactionType::all();
    }

    public function avaiableOrNot($id)
    {
        $types = TransactionType::find($id);
        $types->is_available = !$types->is_available;
        $types->save();
        $this->transactionType = TransactionType::all();
    }
    public function impactOnStock($id)
    {
        $types = TransactionType::find($id);
        $types->stock_impact = !$types->stock_impact;
        $types->save();
        $this->transactionType = TransactionType::all();
    }
}
