<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $type;
    public $floating;
    public $label;
    public $name;
    public $value;
    public $help;

    public function __construct($type = 'text', $floating = false, $label = null, $name = null, $value = null, $help = null)
    {
        $this->type = $type;
        $this->floating = $floating;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->help = $help;
    }

    public function render()
    {
        return view('components.form-input');
    }
}
