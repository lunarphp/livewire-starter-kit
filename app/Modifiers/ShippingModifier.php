<?php

namespace App\Modifiers;

use Lunar\Models\Cart;

class ShippingModifier
{
    public function handle(Cart $cart, \Closure $next)
    {
        /**
         * Custom shipping option.
         * --------------------------------------------
         * If you do not wish to use the shipping add-on you can add
         * your own shipping options that will appear at checkout
         */

        if(config('shipping-tables.enabled') == false){
            \Lunar\Facades\ShippingManifest::addOption(
                new \Lunar\DataTypes\ShippingOption(
                    name: 'Basic Delivery',
                    description: 'Basic Delivery',
                    identifier: 'BASDEL',
                    price: new \Lunar\DataTypes\Price(500, $cart->currency, 1),
                    taxClass: \Lunar\Models\TaxClass::getDefault()
                )
            );
        }

        return $next($cart);
    }
}
