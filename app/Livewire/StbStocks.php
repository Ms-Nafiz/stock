<?php

namespace App\Livewire;

use App\Models\STb;
use Livewire\Component;

class StbStocks extends Component
{
    public $msg;
    public function render()
    {
        $stbStock = STb::where('is_stock', true)->orWhereNull('is_stock')->get();
        return view('livewire.stb-stocks', compact('stbStock'));
    }

    public function updateStock($id)
    {
        $stb = STb::find($id);
        $stb->is_stock = !$stb->is_stock;
        $stb->save();
        $this->msg = 'STB stock updated!';
    }

}
