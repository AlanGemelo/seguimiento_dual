<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class ShowButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $url;

    public $title;

    public function __construct($url = null, $title = null)
    {
        $this->url = $url;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.show-button');
    }
}
