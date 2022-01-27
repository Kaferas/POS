<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class Report extends Component
{
    public $current = null;

    public function __construct()
    {
        if (!Gate::allows('is_admin')) {
            abort(403);
        }
    }
    public function render()
    {
        return view('livewire.report');
    }

    public function whatisCurrent($is)
    {
        $this->current = $is;
    }
}
