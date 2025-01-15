<?php

namespace App\Livewire;

use App\Livewire\Traits\WithSearch;
use App\Traits\FetchesUrls;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Collection as CollectionModel;
use Lunar\Search\Contracts\SearchManagerContract;

class CollectionPage extends Component
{
    use FetchesUrls;
    use WithPagination;
    use WithSearch;

    public function mount(string $slug): void
    {
        $this->url = $this->fetchUrl(
            $slug,
            (new CollectionModel)->getMorphClass(),
            [
                'element.thumbnail',
                'element.products.variants.basePrices',
                'element.products.defaultUrl',
            ]
        );



        if (! $this->url) {
            abort(404);
        }

        $this->filters = [
            'collection_ids' => [$this->collection->id]
        ];
    }

    #[Computed]
    public function collection(): mixed
    {
        return $this->url->element;
    }

    public function render(): View
    {
        return view('livewire.collection-page');
    }
}
