<?php

namespace App\Livewire;

use App\Imports\StbImport as ImportsStbImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class StbImport extends Component
{
    use WithFileUploads;
    public $excelFile;
    public function render()
    {
        return view('livewire.stb-import');
    }

    public function importStb()
    {
        $this->validate([
            'excelFile' => 'required'
        ]);
        Excel::import(new ImportsStbImport, $this->excelFile->getRealPath());

        session()->flash('message', 'File successfully imported!');
    }
}
