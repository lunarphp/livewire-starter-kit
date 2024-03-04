<?php

namespace Tests\Unit\Http\Livewire;

use App\Livewire\ProductPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Lunar\Models\Currency;
use Lunar\Models\Language;
use Lunar\Models\Price;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Tests\TestCase;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_component_can_mount()
    {
        Language::factory()->create([
            'default' => true,
        ]);

        $currency = Currency::factory()->create([
            'default' => true,
        ]);

        $product = Product::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->has(ProductVariant::factory()->afterCreating(function ($variant) use ($currency) {
                $variant->prices()->create(
                    Price::factory()->make([
                        'currency_id' => $currency->id,
                    ])->getAttributes()
                );
            }), 'variants')
            ->create();

        Livewire::test(ProductPage::class, ['slug' => $product->defaultUrl->slug])
            ->assertViewIs('livewire.product-page');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_correct_product_is_loaded()
    {
        Language::factory()->create([
            'default' => true,
        ]);

        $currency = Currency::factory()->create([
            'default' => true,
        ]);

        $product = Product::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->has(ProductVariant::factory()->afterCreating(function ($variant) use ($currency) {
                $variant->prices()->create(
                    Price::factory()->make([
                        'currency_id' => $currency->id,
                    ])->getAttributes()
                );
            }), 'variants')
            ->create();

        Livewire::test(ProductPage::class, ['slug' => $product->defaultUrl->slug])
            ->assertViewIs('livewire.product-page')
            ->assertSet('product.id', $product->id);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_product_is_visible()
    {
        Language::factory()->create([
            'default' => true,
        ]);

        $currency = Currency::factory()->create([
            'default' => true,
        ]);

        $product = Product::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->has(ProductVariant::factory()->afterCreating(function ($variant) use ($currency) {
                $variant->prices()->create(
                    Price::factory()->make([
                        'currency_id' => $currency->id,
                    ])->getAttributes()
                );
            }), 'variants')
            ->create();

        Livewire::test(ProductPage::class, ['slug' => $product->defaultUrl->slug])
            ->assertViewIs('livewire.product-page')
            ->assertSee($product->translateAttribute('name'));
    }
}
