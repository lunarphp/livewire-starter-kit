<div>
  <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
    <div class="flex">
        <div class="space-y-6 grow">
            @include('partials.checkout.address', [
                'type' => 'shipping',
                'step' => $steps['shipping_address'],
            ])

            @include('partials.checkout.shipping_option', [
                'step' => $steps['shipping_option'],
            ])

            @include('partials.checkout.address', [
                'type' => 'billing',
                'step' => $steps['billing_address'],
            ])

            @include('partials.checkout.payment', [
                'step' => $steps['payment']
            ])
        </div>
        <div class="w-1/3 ml-12">
            <div class="sticky">
                <h3 class="font-bold">Order Summary</h3>

                <div class="mt-6">
                    <div class="space-y-6">
                    @foreach($cart->lines as $line)
                        <div wire:key="cart_line_{{ $line->id }}" class="flex items-center">
                            <figure>
                                <img src="{{ $line->purchasable->getThumbnail() }}" class="rounded w-14" />
                            </figure>
                            <div class="ml-4">
                                <strong class="block">{{ $line->purchasable->getDescription() }}</strong>
                                {{ $line->quantity }} @ {{ $line->subTotal->formatted() }}
                            </div>
                        </div>
                    @endforeach
                    </div>
                    <div class="flex justify-between pt-4 mt-4 border-t">
                        <strong class="block">Sub Total</strong>
                        {{ $cart->subTotal->formatted() }}
                    </div>
                    @if($this->shippingOption)
                        <div class="flex justify-between pt-4 mt-4 border-t">
                            <strong class="block">
                                {{ $this->shippingOption->getDescription() }}
                            </strong>
                            {{ $this->shippingOption->getPrice()->formatted() }}
                        </div>

                    @endif
                    @foreach($cart->taxBreakdown as $tax)
                        <div class="flex justify-between pt-4 mt-4 border-t">
                            <strong class="block">{{ $tax['rate']->name }}</strong>
                            {{ $tax['total']->formatted() }}
                        </div>
                    @endforeach
                    <div class="flex justify-between pt-4 mt-4 border-t">
                        <strong class="block">Total</strong>
                        {{ $cart->total->formatted() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
