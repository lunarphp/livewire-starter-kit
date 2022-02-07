<?php

namespace Tests\Unit\Http\Livewire;

use App\Http\Livewire\CheckoutPage;
use App\Http\Livewire\Components\CheckoutAddress;
use App\Http\Livewire\Components\Navigation;
use App\Http\Livewire\Home;
use GetCandy\Facades\CartSession;
use GetCandy\Models\Cart;
use GetCandy\Models\CartAddress;
use GetCandy\Models\Collection;
use GetCandy\Models\Country;
use GetCandy\Models\TaxClass;
use GetCandy\Models\TaxZone;
use GetCandy\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @group livewire.components.checkout
 */
class CheckoutPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the component mounts correctly.
     *
     * @return void
     */
    public function test_component_can_mount()
    {
        CartSession::shouldReceive('current')->andReturn(
            Cart::factory()->create()->getManager()->getCart()
        );

        Livewire::test(CheckoutPage::class)
            ->assertViewIs('livewire.checkout-page');
    }

    /**
     * Test the component mounts correctly.
     *
     * @group moomoo
     * @return void
     */
    public function test_checkout_step_is_correct_on_load()
    {
        CartSession::shouldReceive('current')->andReturn(
            Cart::factory()->create()->getManager()->getCart()
        );

        Livewire::test(CheckoutPage::class)
            ->assertViewIs('livewire.checkout-page')
            ->assertSet('currentStep', 1);
    }

    /**
     * Test the component mounts correctly.
     *
     * @return void
     */
    public function test_checkout_step_is_correct_with_shipping_on_load()
    {
        TaxClass::factory()->create([
            'default' => true,
        ]);

        $cart = Cart::factory()->create();

        $cart->addresses()->create(
            CartAddress::factory()->make([
                'type' => 'shipping',
            ])->toArray()
        );

        CartSession::shouldReceive('current')->andReturn(
            $cart->getManager()->getCart()
        );

        Livewire::test(CheckoutPage::class)
            ->assertViewIs('livewire.checkout-page')
            ->assertSet('currentStep', 2);
    }

    /**
     * Test the component mounts correctly.
     *
     * @return void
     */
    public function test_checkout_on_billing_if_we_have_shipping_option()
    {
        TaxClass::factory()->create([
            'default' => true,
        ]);

        TaxZone::factory()->create([
            'default' => true,
        ]);

        $cart = Cart::factory()->create();

        $cart->addresses()->create(
            CartAddress::factory()->make([
                'type' => 'shipping',
                'shipping_option' => 'BASDEL',
            ])->toArray()
        );

        CartSession::shouldReceive('current')->andReturn(
            $cart->getManager()->getCart()
        );

        Livewire::test(CheckoutPage::class)
            ->assertViewIs('livewire.checkout-page')
            ->assertSet('currentStep', 3);
    }

    /**
     * Test the component mounts correctly.
     *
     * @return void
     */
    public function test_checkout_on_payment_if_we_have_billing_address()
    {
        TaxClass::factory()->create([
            'default' => true,
        ]);

        TaxZone::factory()->create([
            'default' => true,
        ]);

        $cart = Cart::factory()->create();

        $cart->addresses()->create(
            CartAddress::factory()->make([
                'type' => 'shipping',
                'shipping_option' => 'BASDEL',
            ])->toArray()
        );

        $cart->addresses()->create(
            CartAddress::factory()->make([
                'type' => 'billing',
            ])->toArray()
        );

        CartSession::shouldReceive('current')->andReturn(
            $cart->getManager()->getCart()
        );

        Livewire::test(CheckoutPage::class)
            ->assertViewIs('livewire.checkout-page')
            ->assertSet('currentStep', 4);
    }

    /**
     * Test we can save the shipping address
     *
     * @return void
     */
    public function can_save_shipping_address()
    {
        TaxClass::factory()->create([
            'default' => true,
        ]);

        TaxZone::factory()->create([
            'default' => true,
        ]);

        $cart = Cart::factory()->create();

        CartSession::shouldReceive('current')->andReturn(
            $cart->getManager()->getCart()
        );

        $country = Country::factory()->create();

        Livewire::test(CheckoutPage::class)
            ->assertViewIs('livewire.checkout-page')
            ->call('saveAddress', 'shipping')
            ->assertHasErrors([
                "shipping.first_name" => 'required',
                "shipping.last_name" => 'required',
                "shipping.line_one" => 'required',
                "shipping.country_id" => 'required',
                "shipping.city" => 'required',
                "shipping.postcode" => 'required',
                "shipping.contact_email" => 'email',
            ])
            ->set('address.first_name', 'Tony')
            ->set('address.last_name', 'Stark')
            ->set('address.company_name', 'Stark Industries')
            ->set('address.line_one', '1200 Industrial Ave')
            ->set('address.line_two', null)
            ->set('address.line_three', null)
            ->set('address.city', 'Long Beach')
            ->set('address.state', 'CA')
            ->set('address.postcode', '90803')
            ->set('address.delivery_instructions', 'Press the buzzer')
            ->set('address.contact_email', 'deliveries@stark.co')
            ->set('address.contact_phone', '123123123')
            ->set('address.country_id', $country->id)
            ->call('saveAddress', 'shipping')
            ->assertHasNoErrors();
    }
    // /**
    //  * Test validation is set.
    //  *
    //  * @return void
    //  */
    // public function test_validation_is_set()
    // {
    //     CartSession::shouldReceive('getCart')->andReturn(
    //         Cart::factory()->create()
    //     );

    //     Livewire::test(CheckoutAddress::class)
    //         ->assertSet('editing', true)
    //         ->assertSet('address.first_name', null)
    //         ->assertSet('address.last_name', null)
    //         ->assertSet('address.company_name', null)
    //         ->assertSet('address.line_one', null)
    //         ->assertSet('address.line_two', null)
    //         ->assertSet('address.line_three', null)
    //         ->assertSet('address.city', null)
    //         ->assertSet('address.state', null)
    //         ->assertSet('address.postcode', null)
    //         ->assertSet('address.delivery_instructions', null)
    //         ->assertSet('address.contact_email', null)
    //         ->assertSet('address.contact_phone', null)
    //         ->assertSet('address.country_id', null)
    //         ->set('address.contact_email', 'foobar')
    //         ->call('save')
    //         ->assertHasErrors([
    //             'address.first_name' => 'required',
    //             'address.last_name' => 'required',
    //             'address.line_one' => 'required',
    //             'address.country_id' => 'required',
    //             'address.city' => 'required',
    //             'address.postcode' => 'required',
    //             'address.contact_email' => 'email',
    //         ]);
    // }

    // /**
    //  * Test we can save a billing address.
    //  *
    //  * @return void
    //  */
    // public function test_can_save_billing_address()
    // {
    //     CartSession::shouldReceive('getCart')->andReturn(
    //         Cart::factory()->create()
    //     );

    //     $country = Country::factory()->create();

    //     Livewire::test(CheckoutAddress::class)
    //         ->set('address.first_name', 'Tony')
    //         ->set('address.last_name', 'Stark')
    //         ->set('address.company_name', 'Stark Industries')
    //         ->set('address.line_one', '1200 Industrial Ave')
    //         ->set('address.line_two', null)
    //         ->set('address.line_three', null)
    //         ->set('address.city', 'Long Beach')
    //         ->set('address.state', 'CA')
    //         ->set('address.postcode', '90803')
    //         ->set('address.delivery_instructions', 'Press the buzzer')
    //         ->set('address.contact_email', 'deliveries@stark.co')
    //         ->set('address.contact_phone', '123123123')
    //         ->set('address.country_id', $country->id)
    //         ->call('save')
    //         ->assertHasNoErrors();

    //     $this->assertDatabaseHas((new CartAddress)->getTable(), [
    //         'first_name' => 'Tony',
    //         'last_name' => 'Stark',
    //         'company_name' => 'Stark Industries',
    //         'line_one' => '1200 Industrial Ave',
    //         'city' => 'Long Beach',
    //         'state' => 'CA',
    //         'postcode' => '90803',
    //         'delivery_instructions' => 'Press the buzzer',
    //         'contact_email' => 'deliveries@stark.co',
    //         'contact_phone' => '123123123',
    //         'country_id' => $country->id,
    //         'type' => 'billing',
    //     ]);
    // }

    // /**
    //  * Test we can save a shipping address.
    //  *
    //  * @return void
    //  */
    // public function test_can_save_shipping_address()
    // {
    //     CartSession::shouldReceive('getCart')->andReturn(
    //         Cart::factory()->create()
    //     );

    //     $country = Country::factory()->create();

    //     Livewire::test(CheckoutAddress::class, ['type' => 'shipping'])
    //         ->set('address.first_name', 'Tony')
    //         ->set('address.last_name', 'Stark')
    //         ->set('address.company_name', 'Stark Industries')
    //         ->set('address.line_one', '1200 Industrial Ave')
    //         ->set('address.line_two', null)
    //         ->set('address.line_three', null)
    //         ->set('address.city', 'Long Beach')
    //         ->set('address.state', 'CA')
    //         ->set('address.postcode', '90803')
    //         ->set('address.delivery_instructions', 'Press the buzzer')
    //         ->set('address.contact_email', 'deliveries@stark.co')
    //         ->set('address.contact_phone', '123123123')
    //         ->set('address.country_id', $country->id)
    //         ->call('save')
    //         ->assertHasNoErrors();

    //     $this->assertDatabaseHas((new CartAddress)->getTable(), [
    //         'first_name' => 'Tony',
    //         'last_name' => 'Stark',
    //         'company_name' => 'Stark Industries',
    //         'line_one' => '1200 Industrial Ave',
    //         'city' => 'Long Beach',
    //         'state' => 'CA',
    //         'postcode' => '90803',
    //         'delivery_instructions' => 'Press the buzzer',
    //         'contact_email' => 'deliveries@stark.co',
    //         'contact_phone' => '123123123',
    //         'country_id' => $country->id,
    //         'type' => 'shipping',
    //     ]);
    // }

    // /**
    //  * Test we can save a shipping address.
    //  *
    //  * @return void
    //  */
    // public function test_address_is_prefilled_if_it_exists()
    // {
    //     $cart = Cart::factory()->create();

    //     $billingAddress = CartAddress::factory()->make([
    //         'type' => 'billing',
    //     ]);

    //     $shippingAddress = CartAddress::factory()->make([
    //         'type' => 'shipping',
    //     ]);

    //     $cart->addresses()->createMany([
    //         $billingAddress->toArray(),
    //         $shippingAddress->toArray()
    //     ]);

    //     CartSession::shouldReceive('getCart')->andReturn(
    //         $cart
    //     );

    //     $addresses = [
    //         'billing' => $billingAddress,
    //         'shipping' => $shippingAddress,
    //     ];

    //     foreach ($addresses as $type => $address) {
    //         Livewire::test(CheckoutAddress::class, ['type' => $type])
    //             ->assertSet('address.first_name', $address->first_name)
    //             ->assertSet('address.last_name', $address->last_name)
    //             ->assertSet('address.company_name', $address->company_name)
    //             ->assertSet('address.line_one', $address->line_one)
    //             ->assertSet('address.line_two', $address->line_two)
    //             ->assertSet('address.line_three', $address->line_three)
    //             ->assertSet('address.city', $address->city)
    //             ->assertSet('address.state', $address->state)
    //             ->assertSet('address.postcode', $address->postcode)
    //             ->assertSet('address.delivery_instructions', $address->delivery_instructions)
    //             ->assertSet('address.contact_email', $address->contact_email)
    //             ->assertSet('address.contact_phone', $address->contact_phone)
    //             ->assertSet('address.country_id', $address->country_id);
    //     }
    // }

    // /**
    //  * Test we are editing by default.
    //  *
    //  * @return void
    //  */
    // public function test_editing_is_on_by_default()
    // {
    //     $cart = Cart::factory()->create();

    //     CartSession::shouldReceive('getCart')->andReturn(
    //         $cart
    //     );

    //     Livewire::test(CheckoutAddress::class)
    //         ->assertSet('editing', true);
    // }

    // /**
    //  * Test editing only shows when we don't have a complete address on load.
    //  *
    //  * @return void
    //  */
    // public function test_editing_state_is_accurate()
    // {
    //     $cart = Cart::factory()->create();

    //     $billingAddress = CartAddress::factory()->make([
    //         'type' => 'billing',
    //     ]);

    //     $cart->addresses()->createMany([
    //         $billingAddress->toArray()
    //     ]);

    //     CartSession::shouldReceive('getCart')->andReturn(
    //         $cart
    //     );

    //     Livewire::test(CheckoutAddress::class, ['type' => 'billing'])
    //         ->assertSet('editing', false);

    //     Livewire::test(CheckoutAddress::class, ['type' => 'shipping'])
    //         ->assertSet('editing', true);
    // }
}
