<?php

namespace App\View\Components\Alerts;

use Illuminate\View\Component;

class FlashMessages extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('components.alerts.flash-messages');
    }
}