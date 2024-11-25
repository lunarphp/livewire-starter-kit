<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lunar\Models\Discount;
use Lunar\Models\Product as LunarProduct;

class Product extends LunarProduct
{
    /**
     * Compute to return discount.
     */
    public function discount(): ?Discount
    {
        return $this->collections->first()->discounts->first();
    }
}
