<?php

namespace App\View\Components\buttons;

use Illuminate\View\Component;

class SuccessButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $url;
    public $text;
    public function __construct($url = null, $text = null)
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
        return view('components.buttons.success-button');
    }
}
