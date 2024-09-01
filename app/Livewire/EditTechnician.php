<?php

namespace App\Livewire;

use App\Models\Technician;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditTechnician extends ModalComponent
{
    public $name, $mobile, $email;
    public $techId;
    public $success;
    public function render()
    {
        return view('livewire.edit-technician');
    }
    public function mount()
    {
        $tech = Technician::find($this->techId);
        $this->name = $tech->name;
        $this->mobile = $tech->mobile;
        $this->email = $tech->email;
    }

    public function editTechnician()
    {
        $tech = Technician::find($this->techId);
        $tech->name = $this->name;
        $tech->mobile = $this->mobile;
        $tech->email = $this->email;
        $tech->save();
        $this->success = 'Technician Updated';
        $this->dispatch('technicianUpdatd');
    }
}
