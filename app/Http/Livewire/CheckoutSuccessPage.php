<?php

namespace App\Http\Livewire;

use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\Order;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class CheckoutSuccessPage extends Component
{
    use PerformsRedirects;

    public ?Cart $cart;

    public Order $order;

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public function mount()
    {
        $this->cart = CartSession::current();
        if (! $this->cart || ! $this->cart->order) {
            $this->redirect('/');

            return;
        }
        $this->order = $this->cart->order;

        CartSession::forget();
    }

    public function render()
    {
        return view('livewire.checkout-success-page');
    }
}
