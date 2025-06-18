<?php
namespace App\View\Components;

use Illuminate\View\Component;

class PageTitle extends Component
{
    public $title;
    public $createUrl;

    public function __construct($title, $createUrl=null)
    {
        $this->title = $title;
        $this->createUrl = $createUrl;
    }

    public function render()
    {
        return view('components.page-title');
    }
}
