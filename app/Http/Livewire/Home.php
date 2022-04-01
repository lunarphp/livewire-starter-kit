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
        return Url::whereElementType(Collection::class)->whereSlug('sale')->first()?->element ?? null;
    }

    /**
     * Return all images in sale collection.
     *
     * @return void
     */
    public function getSaleCollectionImagesProperty()
    {
        if (! $this->getSaleCollectionProperty()) {
            return;
        }

        $collectionProducts = $this->getSaleCollectionProperty()
            ->products()->inRandomOrder()->limit(4)->get();

        $saleImages = $collectionProducts->map(function ($product) {
            return $product->thumbnail;
        });

        return $saleImages->chunk(2);
    }

    /**
     * Return a random collection.
     *
     * @return void
     */
    public function getRandomCollectionProperty()
    {
        $collections = Url::whereElementType(Collection::class);

        if ($this->getSaleCollectionProperty()) {
            $collections = $collections->where('element_id', '!=', $this->getSaleCollectionProperty()?->id);
        }

        return $collections->inRandomOrder()->first()?->element;
    }

    public function render()
    {
        return view('livewire.home');
    }
}
