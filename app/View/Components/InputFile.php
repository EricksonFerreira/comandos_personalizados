<?php
namespace App\View\Components;

use Illuminate\View\Component;

class InputFile extends Component
{
    public $id;
    public $name;
    public $placeholder;
    public $legend;
    public $required;

    public function __construct($id, $name, $placeholder = 'Choose file...', $legend = 'Browse', $required = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->legend = $legend;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.input-file');
    }
}
