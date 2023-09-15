<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Lunar\Base\Purchasable;
use Lunar\Facades\CartSession;

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
     * @var int
     */
    public $quantity = 1;

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'quantity' => 'required|numeric|min:1|max:10000',
        ];
    }

    public function addToCart()
    {
        if($this->purchasable->stock < $this->quantity){
            $this->addError('quantity', 'The quantity exceeds the available stock.');
        }else{
            CartSession::manager()->add($this->purchasable, $this->quantity);
            $this->emit('add-to-cart');
        }
    }

    public function render()
    {
        return view('livewire.components.add-to-cart');
    }
}
