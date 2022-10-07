<?php

namespace App\Http\Livewire\Chart;

use Livewire\Component;

class ChartComponent extends Component
{
    public $myData = [];

    public function mount($element){
        $this->myData =  $element;
    }

    public function render()
    {
        $data=[103,45,2,5,65];
        return view('livewire.chart.chart-component',[
            'line' => $data
        ]);
    }
}
