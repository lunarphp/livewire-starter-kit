<?php

namespace App\Http\Livewire\Components;

use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\CartAddress;
use Lunar\Models\Country;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CheckoutAddress extends Component
{
    /**
     * The type of address.
     *
     * @var string
     */
    public $type = 'billing';

    /**
     * The ID of the cart.
     *
     * @var string|int
     */
    public Cart $cart;

    /**
     * Whether we are currently editing the address.
     *
     * @var bool
     */
    public bool $editing = false;

    /**
     * The checkout address model.
     *
     * @var \Lunar\Models\CartAddress
     */
    public CartAddress $address;

    /**
     * Whether billing is the same as shipping.
     *
     * @var bool
     */
    public bool $shippingIsBilling = false;

    protected $listeners = [
        'refreshAddress',
    ];

    /**
     * {@inheritDoc}
     */
    public function mount()
    {
        $this->cart = CartSession::current();

        $this->address = $this->cart->addresses->first(fn ($add) => $add->type == $this->type) ?: new CartAddress;

        // If we have an existing ID then it should already be valid and ready to go.
        $this->editing = (bool) ! $this->address->id;
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'address.first_name' => 'required',
            'address.last_name' => 'required',
            'address.line_one' => 'required',
            'address.country_id' => 'required',
            'address.city' => 'required',
            'address.postcode' => 'required',
            'address.company_name' => 'nullable',
            'address.line_two' => 'nullable',
            'address.line_three' => 'nullable',
            'address.state' => 'nullable',
            'address.delivery_instructions' => 'nullable',
            'address.contact_email' => 'nullable|email',
            'address.contact_phone' => 'nullable',
        ];
    }

    /**
     * Save the cart address.
     *
     * @return void
     */
    public function save()
    {
        $validatedData = $this->validate();

        if ($this->type == 'billing') {
            $this->cart->setBillingAddress($this->address);
        }

        if ($this->type == 'shipping') {
            $this->cart->setShippingAddress($this->address);
            if ($this->shippingIsBilling) {
                // Do we already have a billing address?
                if ($billing = $this->cart->billingAddress) {
                    $billing->fill($validatedData['address']);
                    $this->cart->setBillingAddress($billing);
                } else {
                    $address = $this->address->only(
                        $this->address->getFillable()
                    );
                    $this->cart->setBillingAddress($address);
                }
            }
        }

        $this->editing = false;

        $this->emitUp('addressUpdated');
    }

    public function refreshAddress()
    {
        if ($address = $this->cart->addresses()->whereType($this->type)->first()) {
            $this->address = $address;
            $this->editing = false;
        }
    }

    public function getCountriesProperty()
    {
        return Country::whereIn('iso3', ['GBR', 'USA'])->get();
    }

    public function render()
    {
        return view('livewire.components.checkout-address');
    }
}
