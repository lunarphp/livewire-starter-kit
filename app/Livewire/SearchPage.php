<?php

namespace App\Livewire;

use App\Livewire\Traits\SearchesProducts;
use App\Livewire\Traits\WithSearch;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Product;
use Lunar\Search\Contracts\SearchManagerContract;
use Lunar\Search\Data\SearchResults;
use Lunar\Search\Facades\Search;

class SearchPage extends Component
{
    use WithPagination;
    use WithSearch;

    public function mount(Request $request)
    {
        $this->query = (string) $request->get('query', '');
    }

    public function render(): View
    {
        return view('livewire.search-page');
    }
}
