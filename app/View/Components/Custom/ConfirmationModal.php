<?php

namespace App\View\Components\Custom;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    public $action;
    public $note;
    public $title;
    public $message;
    public $confirmText;

    /**
     * Create a new component instance.
     */
    public function __construct($action, $note, $title = 'Confirmation', $message = 'Are you sure you want to proceed?', $confirmText = 'Confirm')
    {
        $this->action = $action;
        $this->note = $note;
        $this->title = $title;
        $this->message = $message;
        $this->confirmText = $confirmText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom.confirmation-modal');
    }
}
