<?php
namespace App\View\Components;

use Illuminate\View\Component;

class FormSelect extends Component
{
    public $name;
    public $label;
    public $options;
    public $placeholder;
    public $selected;
    public $multiple;
    public $floating;
    public $help;

    public function __construct(
        $name,
        $label = null,
        $options = [],
        $placeholder = null,
        $selected = null,
        $multiple = false,
        $floating = false,
        $help = null
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->selected = $selected;
        $this->multiple = $multiple;
        $this->floating = $floating;
        $this->help = $help;
    }

    public function isSelected($key)
    {
        if (is_array($this->selected)) {
            return in_array($key, $this->selected);
        }
        return $this->selected == $key;
    }

    public function nothingSelected()
    {
        return is_null($this->selected);
    }

    public function id()
    {
        return $this->name . '-' . uniqid();
    }

    public function render()
    {
        return view('components.form-select');
    }
}
