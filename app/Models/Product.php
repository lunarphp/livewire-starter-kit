<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lunar\Models\Collection;
use Lunar\Models\Discount;
use Lunar\Models\Product as LunarProduct;

class Product extends LunarProduct
{
    /**
     * Compute to return discount.
     */
    public function discount(): ?Discount
    {
        $collections = $this->collections;
        return Discount::active()
        ->usable()
        ->whereHas('collections', function($query) use ($collections) {
            $prefix = config('lunar.database.table_prefix');
            $query->whereIn("{$prefix}collection_discount.collection_id", $collections->pluck('id'));
        })
        ->orderBy('priority', 'desc')
        ->orderBy('id')
        ->first();
    }
}
