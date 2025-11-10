<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Lunar\Facades\Payments;
use Lunar\Models\Cart;
use Lunar\Stripe\Models\StripePaymentIntent;

class CheckoutProcessing extends Component
{

    public StripePaymentIntent $paymentIntent;

    public string $paymentIntentClientSecret;

    public int $tries = 0;

    public function mount(Request $request)
    {
        $this->paymentIntent = StripePaymentIntent::where('intent_id', $request->get('payment_intent'))->firstOrFail();
        $this->paymentIntentClientSecret = $request->get('payment_intent_client_secret');
    }

    public function checkStatus(): void
    {
        if (! $this->cart?->completedOrder()->exists()) {
            $this->tries++;
        }

        if ($this->tries >= 5) {
            $this->manuallyProcessOrder();
        }

        if ($this->cart?->completedOrder()->exists()) {
            to_route('checkout-success.view', [
                'cartId' => $this->cart->id,
            ]);
        }
    }

    protected function manuallyProcessOrder(): void
    {
        $this->paymentIntent->update([
            'processing_at' => now(),
        ]);

        Payments::driver('stripe')->cart($this->cart)->withData([
            'payment_intent_client_secret' => $this->paymentIntentClientSecret,
            'payment_intent' => $this->paymentIntent->intent_id,
        ])->authorize();
    }

    public function hydrate()
    {
        $this->checkStatus();
    }

    public function getCartProperty()
    {
        return $this->paymentIntent->cart;
    }

    public function render()
    {
        return view('livewire.checkout-processing');
    }
}
