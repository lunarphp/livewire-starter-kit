<?php

namespace Tests\Unit\Http\Livewire;

use App\Http\Livewire\CollectionPage;
use GetCandy\Models\Collection;
use GetCandy\Models\Currency;
use GetCandy\Models\Price;
use GetCandy\Models\Product;
use GetCandy\Models\ProductVariant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CollectionPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_component_can_mount()
    {
        $collection = Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->create();

        Livewire::test(CollectionPage::class, ['slug' => $collection->urls->first()->slug])
            ->assertViewIs('livewire.collection-page');
    }

    /**
     * Test 404 when slug doesn't exist.
     *
     * @return void
     */
    public function test_404_if_not_found()
    {
        Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->create();

        Livewire::test(CollectionPage::class, ['slug' => 'foobar'])
            ->assertStatus(404);
    }

    /**
     * Test collection can be loaded via slug.
     *
     * @return void
     */
    public function test_collection_is_rendered()
    {
        $collection = Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->create();

        Livewire::test(CollectionPage::class, ['slug' => $collection->urls->first()->slug])
            ->assertSee($collection->translateAttribute('name'))
            ->assertViewIs('livewire.collection-page');
    }

    /**
     * Test products are loaded on the page.
     *
     * @return void
     */
    public function test_collection_renders_products()
    {
        $currency = Currency::factory()->create([
            'default' => true,
        ]);

        $collection = Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->has(
                Product::factory(4)
                    ->hasUrls(1, [
                        'default' => true,
                    ])
                    ->has(ProductVariant::factory()->afterCreating(function ($variant) use ($currency) {
                        $variant->prices()->create(
                            Price::factory()->make([
                                'currency_id' => $currency->id,
                            ])->getAttributes()
                        );
                    }), 'variants')
            )->create();

        $component = Livewire::test(CollectionPage::class, ['slug' => $collection->urls->first()->slug])
            ->assertViewIs('livewire.collection-page');

        foreach ($collection->products as $product) {
            $component->assertSee($product->translateAttribute('name'));
        }
    }
}
