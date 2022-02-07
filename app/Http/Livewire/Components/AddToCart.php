<?php

namespace App\Http\Livewire\Components;

use GetCandy\Base\Purchasable;
use GetCandy\Facades\CartSession;
use Livewire\Component;

class AddToCart extends Component
{
    /**
     * The purchasable model we want to add to the cart.
     *
     * @var Purchasable
     */
    public ?Purchasable $purchasable = null;

    /**
     * The quantity to add to cart.
     *
     * @var integer
     */
    public $quantity = 1;

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'quantity' => 'min:1',
        ];
    }

    public function addToCart()
    {
        CartSession::manager()->add($this->purchasable, $this->quantity);
        $this->emit('add-to-cart');
    }

    public function render()
    {
        return view('livewire.components.add-to-cart');
    }
}
