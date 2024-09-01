<?php

namespace App\Livewire;

use App\Models\Technician;
use Livewire\Component;

class HandleTechnician extends Component
{
    public $updateMsg;
    public $technicians;

    protected $listeners = ['newTechAdded' => 'updateTechnician','technicianUpdatd'=>'updateTechnician'];
    public function render()
    {
        $technicians = Technician::all();
        return view('livewire.handle-technician', compact('technicians'));
    }

    public function mount()
    {
        $this->technicians = Technician::orderBy('created_at','desc')->get();
    }

    public function updateTechnician()
    {
        $this->technicians = Technician::orderBy('created_at','desc')->get();
    }
    public function updateStatus($id)
    {
        $tech = Technician::find($id);
        $tech->is_active = !$tech->is_active;
        $tech->save();

        $this->updateMsg = 'Technician status has been updated';

        $this->technicians = Technician::all();
    }
}
