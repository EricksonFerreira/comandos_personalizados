<?php
namespace App\View\Components;

use Illuminate\View\Component;

class PerPageSelector extends Component
{
    public $perPages;
    public $selectedPerPage;

    public function __construct($perPages, $selectedPerPage)
    {
        $this->perPages = $perPages;
        $this->selectedPerPage = $selectedPerPage;
    }

    public function render()
    {
        return view('components.per-page-selector');
    }
}
