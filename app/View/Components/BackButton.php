<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BackButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $url;
    public $text;

    public function __construct($url = null, $text="Volver")
    {
        $this->url = $url ?? url()->previous();
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.back-button');
    }
}
