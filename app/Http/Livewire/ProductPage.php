<?php

namespace App\Http\Livewire;

use App\Traits\FetchesUrls;
use Livewire\Component;
use Lunar\Models\Product;

class ProductPage extends Component
{
    use FetchesUrls;

    /**
     * The selected option values.
     *
     * @var array
     */
    public $selectedOptionValues = [];

    /**
     * {@inheritDoc}
     *
     * @param  string  $slug
     * @return void
     */
    public function mount($slug)
    {
        $this->url = $this->fetchUrl(
            $slug,
            Product::class,
            [
                'element.media',
                'element.variants.basePrices.currency',
                'element.variants.basePrices.priceable',
                'element.variants.values.option',
            ]
        );

        $this->selectedOptionValues = $this->productOptions->mapWithKeys(function ($data) {
            return [$data['option']->id => $data['values']->first()->id];
        })->toArray();

        if (! $this->variant) {
            abort(404);
        }
    }

    /**
     * Computed property to get variant.
     *
     * @return \Lunar\Models\ProductVariant
     */
    public function getVariantProperty()
    {
        return $this->product->variants->first(function ($variant) {
            return ! $variant->values->pluck('id')
                ->diff(
                    collect($this->selectedOptionValues)->values()
                )->count();
        });
    }

    /**
     * Computed property to return all available option values.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProductOptionValuesProperty()
    {
        return $this->product->variants->pluck('values')->flatten();
    }

    /**
     * Computed propert to get available product options with values.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProductOptionsProperty()
    {
        return $this->productOptionValues->unique('id')->groupBy('product_option_id')
            ->map(function ($values) {
                return [
                    'option' => $values->first()->option,
                    'values' => $values,
                ];
            })->values();
    }

    /**
     * Computed property to return product.
     *
     * @return \Lunar\Models\Product
     */
    public function getProductProperty()
    {
        return $this->url->element;
    }

    /**
     * Return all images for the product.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getImagesProperty()
    {
        return $this->product->media;
    }

    /**
     * Computed property to return current image.
     *
     * @return string
     */
    public function getImageProperty()
    {
        if (count($this->variant->images)) {
            return $this->variant->images->first();
        }

        if ($primary = $this->images->first(fn ($media) => $media->getCustomProperty('primary'))) {
            return $primary;
        }

        return $this->images->first();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('livewire.product-page');
    }
}
