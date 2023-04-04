<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Facades\ShippingManifest;

class ShippingOptions extends Component
{
    /**
     * The chosen shipping option.
     */
    public ?string $chosenOption = null;

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public function mount()
    {
        if ($shippingOption = optional($this->shippingAddress)->shipping_option) {
            $option = $this->shippingOptions->first(function ($opt) use ($shippingOption) {
                return $opt->getIdentifier() == $shippingOption;
            });
            $this->chosenOption = optional($option)->getIdentifier();
        }
    }

    /**
     * Return available shipping options.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getShippingOptionsProperty()
    {
        return ShippingManifest::getOptions(
            CartSession::current()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'chosenOption' => 'required',
        ];
    }

    /**
     * Save the shipping option.
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenOption);

        CartSession::setShippingOption($option);

        $this->emit('selectedShippingOption');
    }

    /**
     * Return whether we have a shipping address.
     *
     * @return void
     */
    public function getShippingAddressProperty()
    {
        return CartSession::getCart()->shippingAddress;
    }

    public function render()
    {
        return view('livewire.components.shipping-options');
    }
}
