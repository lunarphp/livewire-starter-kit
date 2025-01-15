<?php

namespace App\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductIndexer extends \Lunar\Search\ProductIndexer
{
    public function makeAllSearchableUsing(Builder $query): Builder
    {
        return $query->with([
            'thumbnail',
            'variants',
            'productType',
            'brand',
            'prices',
        ]);
    }

    public function toSearchableArray(Model $model): array
    {
//        $productOptions = $product->get();
//        dd($product->variants->pluck('values'));
//
//        dd($model->variants->pluck('values')->flatten());

        $priceModels = $model->prices;

        $basePrice = $priceModels->first(function ($price) {
            return $price->min_quantity == 1;
        });

        $minPrice = $priceModels->sortBy('price')->first();

        $options = $model->productOptions()->with([
            'values' => function ($query) use ($model) {
                $query->whereHas('variants', function ($relation) use ($model) {
                    $relation->where('product_id', $model->id);
                });
            },
        ])->get()->mapWithKeys(function ($option) {
            return [
                $option->handle => $option->values->map(function ($value) {
                    return $value->translate('name');
                })
            ];
        })->toArray();

        return [
            'id' => (string) $model->id,
            'name' => $model->attr('name'),
            'description' => $model->attr('description'),
            'brand' => $model->brand->name,
            'thumbnail' => $model->thumbnail?->getUrl('small'),
            'slug' => $model->defaultUrl?->slug,
            'price' => [
                'inc_tax' => [
                    'value' => (int) $basePrice->priceIncTax()->value,
                    'formatted' => $basePrice->priceIncTax()->formatted,
                ],
                'ex_tax' => [
                    'value' => (int) $basePrice->priceExTax()->value,
                    'formatted' => $basePrice->priceExTax()->formatted,
                ],
            ],
            'min_price' => $minPrice?->priceIncTax()?->value ?: 0,
            ...$options,
            ...$this->getCollections($model)
        ];
    }

    private function getCollections(Model $product): array
    {
        $trail = [];

        $categories = [];
        $categoryIds = [];

        foreach ($product->collections as $i => $collection) {
            $levels = [$collection->translateAttribute('name')];
            $levelIds = [$collection->id];
            $node = $collection;

            while ($node->parent) {
                array_unshift($levels, $node->parent->translateAttribute('name'));
                array_unshift($levelIds, $node->parent->id);
                $node = $node->parent;
            }

            foreach ($levels as $level => $name) {
                if (! isset($trail['lvl'.$level])) {
                    $trail['lvl'.$level] = [];
                }

                $key = $level - 1;

                $breadcrumb = [$name];

                while (isset($levels[$key])) {
                    array_unshift($breadcrumb, $levels[$key]);
                    $key--;
                }

                $trail['lvl'.$level][] = implode(' > ', $breadcrumb);
            }

            $categories = array_merge($levels, $categories);
            $categoryIds = array_merge($levelIds, $categoryIds);
        }

        foreach ($trail as $key => $values) {
            $trail[$key] = collect($values)
                ->unique()
                ->values()
                ->toArray();
        }

        return [
            'hierarchical_collections' => $trail,
            'collection_ids' => collect($categoryIds)->unique()->values()->toArray(),
            'collections' => collect($categories)->unique()->values()->toArray(),
        ];
    }
}
