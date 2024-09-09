<?php

namespace App\Livewire;

use App\Models\STb;
use Livewire\Component;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class Dashboard extends Component
{
    public function render()
    {
        $inMyHand = $this->inMyhand();
        $stock = $this->stock();
        return view('livewire.dashboard', compact('inMyHand', 'stock'));
    }

    public function summary($category, $status)
    {
        // in stock
        $inMyHand = STb::where('category', $category)->where('status', $status)->where('is_stock', true)->count();
        $stock = STb::where('category', $category)->where('status', $status)->whereNull('is_stock')->count();
        // in my hand
        return [
            'inMyHand' => $inMyHand,
            'stock' => $stock,
        ];
    }

    public function inMyhand()
    {
        return [
            'good' => [
                'hc' => $this->summary('HC', 'good')['inMyHand'],
                'nl' => $this->summary('NL', 'good')['inMyHand'],
                'nstv' => $this->summary('NSTV', 'good')['inMyHand'],
            ],
            'error' => [
                'hc' => $this->summary('HC', 'error')['inMyHand'],
                'nl' => $this->summary('NL', 'error')['inMyHand'],
                'nstv' => $this->summary('NSTV', 'error')['inMyHand'],
            ]
        ];
    }
    public function stock()
    {
        return [
            'good' => [
                'hc' => $this->summary('HC', 'good')['stock'],
                'nl' => $this->summary('NL', 'good')['stock'],
                'nstv' => $this->summary('NSTV', 'good')['stock'],
            ],
            'error' => [
                'hc' => $this->summary('HC', 'error')['stock'],
                'nl' => $this->summary('NL', 'error')['stock'],
                'nstv' => $this->summary('NSTV', 'error')['stock'],
            ]
        ];
    }
}
