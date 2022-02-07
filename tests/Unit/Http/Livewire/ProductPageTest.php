<?php

namespace Tests\Unit\Http\Livewire;

use App\Http\Livewire\CollectionPage;
use App\Http\Livewire\ProductPage;
use GetCandy\Models\Collection;
use GetCandy\Models\Currency;
use GetCandy\Models\Price;
use GetCandy\Models\Product;
use GetCandy\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
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

        Livewire::test(ProductPage::class, ['slug' => $product->urls->first()->slug])
            ->assertViewIs('livewire.product-page');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_correct_product_is_loaded()
    {
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

        Livewire::test(ProductPage::class, ['slug' => $product->urls->first()->slug])
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

        Livewire::test(ProductPage::class, ['slug' => $product->urls->first()->slug])
            ->assertViewIs('livewire.product-page')
            ->assertSee($product->translateAttribute('name'));
    }
}
