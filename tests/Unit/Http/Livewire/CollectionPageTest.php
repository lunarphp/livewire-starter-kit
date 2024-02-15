<?php

namespace Tests\Unit\Http\Livewire;

use App\Livewire\CollectionPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Lunar\Models\Collection;
use Lunar\Models\Currency;
use Lunar\Models\Language;
use Lunar\Models\Price;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
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
        Language::factory()->create([
            'default' => true,
        ]);

        $collection = Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->create();

        Livewire::test(CollectionPage::class, ['slug' => $collection->defaultUrl->slug])
            ->assertViewIs('livewire.collection-page');
    }

    /**
     * Test 404 when slug doesn't exist.
     *
     * @return void
     */
    public function test_404_if_not_found()
    {
        Language::factory()->create([
            'default' => true,
        ]);

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
        Language::factory()->create([
            'default' => true,
        ]);

        $collection = Collection::factory()
            ->hasUrls(1, [
                'default' => true,
            ])->create();

        Livewire::test(CollectionPage::class, ['slug' => $collection->defaultUrl->slug])
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
        Language::factory()->create([
            'default' => true,
        ]);

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

        $component = Livewire::test(CollectionPage::class, ['slug' => $collection->defaultUrl->slug])
            ->assertViewIs('livewire.collection-page');

        foreach ($collection->products as $product) {
            $component->assertSee($product->translateAttribute('name'));
        }
    }
}
