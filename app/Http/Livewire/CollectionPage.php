<?php

namespace App\Http\Livewire;

use App\Traits\FetchesUrls;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;
use Lunar\Models\Collection;
use Livewire\WithPagination;
use Lunar\Models\Url;

class CollectionPage extends Component
{
    use PerformsRedirects,
        FetchesUrls,
        WithPagination;

        protected $paginationTheme = 'tailwind';
    /**
     * {@inheritDoc}
     *
     * @param  string  $slug
     * @return void
     *
     * @throws \Http\Client\Exception\HttpException
     */
    public function mount($slug)
    {
        $this->url = $this->fetchUrl(
            $slug,
            Collection::class,
        );

        if (! $this->url) {
            abort(404);
        }
    }

    /**
     * Computed property to return the collection.
     *
     * @return \Lunar\Models\Collection
     */
    public function getCollectionProperty()
    {
        $collections = Url::whereElementType(Collection::class)->where('element_id', '=', $this->url->id);
        return $collections->inRandomOrder()->first()?->element;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {

        return view('livewire.collection-page', ['products' => $this->collection->products()->paginate(9)]);
    }
}
