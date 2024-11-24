<?php

namespace App\Modifiers;

use Lunar\DataTypes\Price;
use Lunar\DataTypes\ShippingOption;
use Lunar\Facades\ShippingManifest;
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

        // Get the tax class
        $taxClass = \Lunar\Models\TaxClass::getDefault();

        if(config('shipping-tables.enabled') == false){
            ShippingManifest::addOption(
                new ShippingOption(
                    name: 'Free Delivery',
                    description: 'Estimated in 3-5 working days)',
                    identifier: 'FREDEL',
                    price: new Price(0, $cart->currency, 1),
                    taxClass: $taxClass
                )
            );

            ShippingManifest::addOption(
                new ShippingOption(
                    name: 'Express Delivery',
                    description: 'Estimated in 2 working days',
                    identifier: 'EXDEL',
                    price: new Price(100, $cart->currency, 1),
                    taxClass: $taxClass
                )
            );

            ShippingManifest::addOption(
                new ShippingOption(
                    name: 'Pick up in store',
                    description: 'Self Pick up your order on next working day',
                    identifier: 'PICKUP',
                    price: new Price(0, $cart->currency, 1),
                    taxClass: $taxClass,
                    // This is for your reference, so you can check if a collection option has been selected.
                    collect: true
                )
            );
        }

        return $next($cart);
    }
}
