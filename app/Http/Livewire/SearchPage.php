<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Product;

class SearchPage extends Component
{
    use WithPagination;

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'term',
    ];

    /**
     * The search term.
     */
    public ?string $term = null;

    /**
     * Return the search results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getResultsProperty()
    {
        return Product::search($this->term)->paginate(50);
    }

    public function render()
    {
        return view('livewire.search-page');
    }
}
