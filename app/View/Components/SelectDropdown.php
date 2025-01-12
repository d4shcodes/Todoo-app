<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectDropdown extends Component
{

    public $options;
    public $selected;

    /**
     * Create a new component instance.
     */
    public function __construct($options = [], $selected = null)
    {
        $this->options = $options;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-dropdown');
    }
}
