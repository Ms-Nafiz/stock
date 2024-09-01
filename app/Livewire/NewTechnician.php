<?php

namespace App\Livewire;

use App\Models\Technician;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class NewTechnician extends ModalComponent
{
    public $name;
    public $email;
    public $mobile;
    public $success;
    protected $rules = [
        'name' => 'required',
        'mobile' => 'required|max:11|min:11',
        'email' => 'required|unique:technicians,email',
    ];
    protected $messages = [
        'name.required' => 'Required',
        'mobile.required' => 'Required',
        'email.required' => 'Required',
    ];
    public function render()
    {
        return view('livewire.new-technician');
    }

    public function addTechnician()
    {
        $this->validate();

        $tech = new Technician();
        $tech->name = $this->name;
        $tech->mobile = $this->mobile;
        $tech->email = $this->email;
        $tech->save();

        $this->reset();

        $this->success = 'Technician added successfull!';

        $this->dispatch('newTechAdded');
        $this->closeModal();
    }
}
