<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class BasicInput extends Component
{

    public $type;
    public $name;
    public $id;
    public $value;
    public $attr;
    public $label;
    public $is_required;
    public $is_hidden;
    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $id = null, $value = null, $attr = null, $type = 'text')
    {
        $attr = explode(',', $attr);
        $this->name = $name;
        $this->label = $label;
        $this->id = $id ?? $name;
        $this->value = $value;
        $this->attr = implode(' ', $attr);
        $this->type = $type;
        $this->is_required = in_array('required', $attr);
        $this->is_hidden = in_array('hidden', $attr);

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.basic-input');
    }
}
