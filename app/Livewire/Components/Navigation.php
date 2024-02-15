<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Lunar\Models\Collection;

class Navigation extends Component
{
    /**
     * The search term for the search input.
     *
     * @var string
     */
    public $term = null;

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'term',
    ];

    /**
     * Return the collections in a tree.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCollectionsProperty()
    {
        return Collection::with(['defaultUrl'])->get()->toTree();
    }

    public function render()
    {
        return view('livewire.components.navigation');
    }
}
