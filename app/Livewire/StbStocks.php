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

    public function delete(){
        $numbers = [
            2932019450, 2932019443, 2932021160, 3264916394, 2932019296,
            2932019675, 2932019282, 2932019696, 3264916712, 3264908638,
            2932017627, 2932017415, 3264923852, 2932017610, 2932017645,
            2929132581, 2932017102, 3264911050, 3264921589, 2932017609,
            3264911612, 3264910303, 3264911551, 3264910254, 3264917042,
            3264910064, 3264921996, 3264910240, 3264910302, 3264921902,
            2929132968, 3264921760, 3264925696, 2932019419, 3264921323,
            2932017270, 3264916797, 3264921646, 3264924143, 3264922787,
            2929134297, 3264920010, 3264910458, 3264924109, 3264916772,
            3264921770, 2932017585, 2932017018, 3264913859, 3264917103
        ];
        foreach($numbers as $number){
            $stb = STb::where('nuid', $number)->first();
            $stb->delete();
        }
        $this->msg = 'deleted!';
    }
}
