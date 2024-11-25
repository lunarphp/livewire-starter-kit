<?php

namespace App\View\Components;

use Exception;
use Illuminate\View\Component;
use Illuminate\View\View;
use Lunar\Facades\Pricing;
use Lunar\Models\Price;
use Lunar\Models\ProductVariant;

class ProductPrice extends Component
{
    public ?Price $price = null;

    public ?ProductVariant $variant = null;
    
    public ?\Lunar\DataTypes\Price $discountedPrice = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product = null, $variant = null)
    {
        $this->price = Pricing::for(
            $variant ?: $product->variants->first()
        )->get()->matched;

        $this->discountedPrice = $this->calculateDiscountedPrice(
            $product?: $variant->product
        );        
    }

    private function calculateDiscountedPrice($product): ?\Lunar\DataTypes\Price
    {
        $discount = $product->discount();
        $data = $discount?->data;
        if (!empty($data['percentage'])) {
            $discountValue = $data['percentage'] ?? 0;
            return new \Lunar\DataTypes\Price(
                (int) round($this->price->price->value * ($discountValue / 100)),
                $this->price->currency,
                1
            );
        }
        return null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.product-price');
    }
}
