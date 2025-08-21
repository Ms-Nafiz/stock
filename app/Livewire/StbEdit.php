<?php

namespace App\Livewire;

use App\Models\STb;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class StbEdit extends ModalComponent
{
    public $id;
    public $nuid, $msg;
    public function render()
    {
        return view('livewire.stb-edit');
    }

    public function mount()
    {
        $stb = STb::find($this->id);
        $this->nuid = $stb->nuid;
    }
    public function editStb()
    {
        $findSTb = STb::find($this->id);

        if (! $findSTb) {
            return $this->msg = "STB not found!";
        }

        // ডুপ্লিকেট চেক (নিজ ছাড়া অন্য কারো একই nuid আছে কিনা)
        $isDuplicate = STb::where('nuid', $this->nuid)
            ->where('id', '!=', $this->id)
            ->exists();

        if ($isDuplicate) {
            return $this->msg = "Duplicate Found";
        }

        // নতুন nuid assign
        $findSTb->nuid = $this->nuid;
        $findSTb->save();

        $this->dispatch('editStb', $findSTb->nuid);
        $this->closeModal();
        // return $this->msg = "Stb Updated!";
    }
}
