<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Lunar\Models\Cart;

class CheckoutProcessing extends Component
{
    public string $paymentIntent;

    public function mount(Request $request)
    {
        $this->paymentIntent = $request->get('payment_intent');
    }

    public function hydrate()
    {
        if ($this->cart->completedOrder) {
            to_route('checkout-success.view', [
                'cartId' => $this->cart->id,
            ]);
        }
    }

    public function getCartProperty()
    {
        return Cart::where('meta->payment_intent', '=', $this->paymentIntent)->first();
    }

    public function render()
    {
        return view('livewire.checkout-processing');
    }
}
