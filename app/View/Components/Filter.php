<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Filter extends Component
{
    public $filters;
    public $additionalFilters;
    public $itensFiltered;

    public $nomeFiltro;
    public $urlPadrao;
    public $routeRedirect;

    public function __construct(
        $filters,
        $additionalFilters = [],
        $itensFiltered = []
    ) {
        $this->filters = $filters;
        $this->additionalFilters = $additionalFilters;
        $this->itensFiltered = $itensFiltered;
    }

    public function render()
    {
        return view('components.filter');
    }
}
