<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{

    public $name;
    public $id;
    public $sclass;
    public $label;
    public $attr;
    public $is_required;
    public $is_hidden;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $id = null, $sclass = null, $attr = null)
    {
        $attr = explode(',', $attr);
        $this->name = $name;
        $this->label = $label;
        $this->id = $id;
        $this->sclass = $sclass;
        $this->is_required = in_array('required', $attr);
        $this->is_hidden = in_array('hidden', $attr);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.select');
    }
}
