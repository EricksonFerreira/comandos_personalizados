<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormLabel extends Component
{
    public $label;
    public $required;

    public function __construct($label = null, $required = false)
    {
        $this->label = $label;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.form-label', [
            'label' => $this->label,
            'required' => $this->required,
        ]);
    }
}
