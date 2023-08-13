<?php

namespace App\View\Components\backend;

use Illuminate\View\Component;

class Patient extends Component
{

    public $patientInformation;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($patientInformation)
    {
        //

        $this->patientInformation = $patientInformation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.patient');
    }
}
