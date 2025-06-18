<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormErrors extends Component
{
    public $name;
    public $message;

    public function __construct($name)
    {
        $this->name = $name;
        $this->message = session('errors') ? session('errors')->first($name) : null;
    }

    public function render()
    {
        return view('components.form-errors',['message' => $this->message]);
    }
}
