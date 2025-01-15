<?php

namespace App\Livewire\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Url;
use Lunar\Search\Contracts\SearchManagerContract;
use Lunar\Search\Data\SearchResults;
use Lunar\Search\Facades\Search;

trait WithSearch
{
    #[Modelable]
    #[Url]
    public ?array $facets = [];

    public array $filters = [];

    #[Modelable]
    #[Url]
    public int $perPage = 50;

    #[Modelable]
    #[Url]
    public string $sort = '';

    #[Modelable]
    #[Url]
    public string $query = '';

    public function mountWithSearch(Request $request): void
    {
        $this->sort = (string) $request->get('sort', '');
    }

    #[Computed]
    public function searchInstance(): SearchManagerContract
    {
        $search = Search::model(\Lunar\Models\Product::class);

        if ($this->facets && count($this->facets)) {
            $facets = [];

            foreach ($this->facets as $facet) {
                [$field, $facetValue] = explode(':', urldecode($facet));

                if (empty($facets[$field])) {
                    $facets[$field] = [];
                }

                $facets[$field][] = $facetValue;
            }

            $search->setFacets($facets);
        }

        $search->filter($this->filters);

        return $search;
    }



    #[Computed]
    public function results(): SearchResults
    {

        $sorting = $this->sort ?: '';

        return $this->searchInstance->perPage($this->perPage)->sort($sorting)->query($this->query)->get();
    }

    #[Computed]
    public function displayFacets(): Collection
    {
        return collect($this->results->facets)->reject(
            fn ($facet) => !count($facet->values)
        )->values();
    }

    public function clearFacets(): void
    {
        $this->facets = [];
    }

    public function updatedQuery(): void
    {
        $this->resetPage();
    }

    public function updatedFacets(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
        $this->instance->perPage($this->perPage);
    }

    public function removeFacet(string $facet): void
    {
        $facets = $this->facets;
        unset($facets[
            array_search($facet, $facets)
            ]);
        $this->facets = collect($facets)->values()->toArray();
    }
}
