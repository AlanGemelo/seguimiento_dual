<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SectionHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public $description;

    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.section-header');

    }
}
