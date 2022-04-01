<?php

namespace App\Http\Livewire\Components;

use GetCandy\Facades\CartSession;
use Livewire\Component;

class Cart extends Component
{
    /**
     * The editable cart lines.
     *
     * @var array
     */
    public array $lines;

    public bool $linesVisible = false;

    protected $listeners = [
        'add-to-cart' => 'handleAddToCart',
    ];

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'lines.*.quantity' => 'required|numeric|min:1|max:10000',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function mount()
    {
        $this->mapLines();
    }

    /**
     * Get the current cart instance.
     *
     * @return \GetCandy\Managers\CartManager
     */
    public function getCartProperty()
    {
        return CartSession::current();
    }

    /**
     * Return the cart lines from the cart.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCartLinesProperty()
    {
        return $this->cart->lines ?? collect();
    }

    /**
     * Update the cart lines.
     *
     * @return void
     */
    public function updateLines()
    {
        $this->validate();

        CartSession::manager()->updateLines(
            collect($this->lines)
        );
        $this->mapLines();
        $this->emit('cartUpdated');
    }

    public function removeLine($id)
    {
        CartSession::manager()->removeLine($id);
        $this->mapLines();
    }

    /**
     * Map the cart lines.
     *
     * We want to map out our cart lines like this so we can
     * add some validation rules and make them editable.
     *
     * @return void
     */
    public function mapLines()
    {
        $this->lines = $this->cartLines->map(function ($line) {
            return [
                'id' => $line->id,
                'identifier' => $line->purchasable->getIdentifier(),
                'quantity' => $line->quantity,
                'description' => $line->purchasable->getDescription(),
                'thumbnail' => $line->purchasable->getThumbnail(),
                'option' => $line->purchasable->getOption(),
                'options' => $line->purchasable->getOptions()->implode(' / '),
                'sub_total' => $line->subTotal->formatted(),
                'unit_price' => $line->unitPrice->formatted(),
            ];
        })->toArray();
    }

    public function handleAddToCart()
    {
        $this->mapLines();
        $this->linesVisible = true;
    }

    public function render()
    {
        return view('livewire.components.cart');
    }
}
