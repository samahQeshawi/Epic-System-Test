<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Email extends Component
{
    public $title;
    public $name;
    public $options;
    public $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$name,$options=[],$size=null)
    {
        //
        $this->title = $title;
        $this->name = $name;
        $this->options = $options;
        $this->size = $size;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.email');
    }
}
