<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;

class Carousel extends Component
{
    public $collection;

    public function render(): View
    {
        return view('livewire.components.carousel');
    }
}