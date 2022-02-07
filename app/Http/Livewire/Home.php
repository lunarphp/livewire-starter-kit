<?php

namespace App\Http\Livewire;

use GetCandy\Models\Collection;
use GetCandy\Models\Url;
use Livewire\Component;

class Home extends Component
{
    /**
     * Return the sale collection.
     *
     * @return void
     */
    public function getSaleCollectionProperty()
    {
        return Url::whereElementType(Collection::class)->whereSlug('sale')->first()?->element;
    }

    /**
     * Return a random collection.
     *
     * @return void
     */
    public function getRandomCollectionProperty()
    {
        return Collection::inRandomOrder()->first();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
