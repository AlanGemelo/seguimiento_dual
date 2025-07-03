<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class CancelButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $url;
    public $text;

    public function __construct($url = null, $text = "Cacelar")
    {
        $this->url = $url;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.cancel-button');
    }
}
