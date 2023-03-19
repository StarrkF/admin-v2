<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{

    public $value;
    public $class;
    public $name;
    public $id;
    public $label;
    public $dataClass;
    /**
     * Create a new component instance.
     */
    public function __construct( $id, $label, $name = null, $value = null, $class = null, $dataClass = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
        $this->class = $class;
        $this->dataClass = $dataClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.checkbox');
    }
}
