<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $href;
    public $method;
    public $confirm;
    public $color;
    public $size;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $type = 'button',
        $href = null,
        $method = 'GET',
        $confirm = null,
        $color = 'blue',
        $size = 'md'
    ) {
        $this->type = $type;
        $this->href = $href;
        $this->method = $method;
        $this->confirm = $confirm;
        $this->color = $color;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}