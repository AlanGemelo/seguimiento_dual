<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;

    public $title;

    public $bannerText;

    public $bannerId;

    public $showMotivo;

    public $selectId;

    public $warningId;

    public $formId;

    public $statusId;

    public $action;

    public $method;

    public $buttonText;

    public $motivos;

    public function __construct(
        $id,
        $title,
        $bannerText,
        $bannerId,
        $showMotivo,
        $selectId,
        $warningId,
        $formId,
        $statusId,
        $action,
        $method = 'POST',
        $buttonText = 'Confirmar',
        $motivos = []
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->bannerText = $bannerText;
        $this->bannerId = $bannerId;
        $this->showMotivo = $showMotivo;
        $this->selectId = $selectId;
        $this->warningId = $warningId;
        $this->formId = $formId;
        $this->statusId = $statusId;
        $this->action = $action;
        $this->method = $method;
        $this->buttonText = $buttonText;
        $this->motivos = $motivos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.confirmation-modal');
    }
}
