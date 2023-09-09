<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PanelHeaderFormBackOffice extends Component
{
    public $pagestitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pagestitle)
    {
        $this->pagestitle = $pagestitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.panel-header-form-back-office');
    }
}
