<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TranslatableTextarea extends Component
{
    private $name;
    private $title;
    private $placeholder;
    private $item;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$title,$item=null)
    {
        //
        $this->name = $name;
        $this->title = $title;
        $this->item =isset($item)?$item->getTranslations($name):null ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.translatable-textarea',['name'=>$this->name,'title'=>$this->title,'item'=>$this->item]);
    }

}
