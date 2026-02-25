<?php

namespace App\View\Components\buttons;

use Illuminate\View\Component;

class RestoreButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $parametro;

    public $clases;

    public $funcion; // NUEVO: función a llamar

    public function __construct($parametro = null, $funcion = null, $clases = null)
    {
        $this->parametro = $parametro;
        $this->funcion = $funcion;
        $this->clases = $clases;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.restore-button');
    }
}
