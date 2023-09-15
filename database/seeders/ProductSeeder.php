<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Lunar\FieldTypes\ListField;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Hub\Jobs\Products\GenerateVariants;
use Lunar\Models\Attribute;
use Lunar\Models\Brand;
use Lunar\Models\Collection;
use Lunar\Models\Currency;
use Lunar\Models\Language;
use Lunar\Models\Price;
use Lunar\Models\Product;
use Lunar\Models\ProductOption;
use Lunar\Models\ProductOptionValue;
use Lunar\Models\ProductType;
use Lunar\Models\ProductVariant;
use Lunar\Models\TaxClass;

class ProductSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = $this->getSeedData('products');

        $attributes = Attribute::get();

        $productType = ProductType::first();

        $taxClass = TaxClass::getDefault();

        $currency = Currency::getDefault();

        $collections = Collection::get();

        $language = Language::getDefault();

        DB::transaction(function () use ($products, $attributes, $productType, $taxClass, $currency, $collections) {
            $products->each(function ($product) use ($attributes, $productType, $taxClass, $currency, $collections) {
                $attributeData = [];

                foreach ($product->attributes as $attributeHandle => $value) {
                    $attribute = $attributes->first(fn ($att) => $att->handle == $attributeHandle);

                    if ($attribute->type == TranslatedText::class) {
                        $attributeData[$attributeHandle] = new TranslatedText([
                            'en' => new Text($value),
                        ]);

                        continue;
                    }

                    if ($attribute->type == ListField::class) {
                        $attributeData[$attributeHandle] = new ListField((array) $value);
                    }
                }

                $brand = Brand::firstOrCreate([
                    'name' => $product->brand,
                ]);

                $productModel = Product::create([
                    'attribute_data' => $attributeData,
                    'product_type_id' => $productType->id,
                    'status' => 'published',
                    'brand_id' => $brand->id,
                ]);

                $variant = ProductVariant::create([
                    'product_id' => $productModel->id,
                    'purchasable' => 'always',
                    'shippable' => true,
                    'backorder' => 0,
                    'sku' => $product->sku,
                    'tax_class_id' => $taxClass->id,
                    'stock' => 500,
                ]);

                Price::create([
                    'customer_group_id' => null,
                    'currency_id' => $currency->id,
                    'priceable_type' => ProductVariant::class,
                    'priceable_id' => $variant->id,
                    'price' => $product->price,
                    'tier' => 1,
                ]);

                $media = $productModel->addMedia(
                    base_path("database/seeders/data/images/{$product->image}")
                )->preservingOriginal()->toMediaCollection('products');

                $media->setCustomProperty('primary', true);
                $media->save();

                $collections->each(function ($coll) use ($product, $productModel) {
                    if (in_array(strtolower($coll->translateAttribute('name')), $product->collections)) {
                        $coll->products()->attach($productModel->id);
                    }
                });

                if (! count($product->options ?? [])) {
                    return;
                }

                $options = ProductOption::get();
                $optionValues = ProductOptionValue::get();

                $optionValueIds = [];

                foreach ($product->options ?? [] as $option) {
                    // Do we have this option already?
                    $optionModel = $options->first(fn ($opt) => $option->name == $opt->translate('name'));

                    if (! $optionModel) {
                        $optionModel = ProductOption::create([
                            'name' => [
                                'en' => $option->name,
                            ],
                        ]);
                    }

                    foreach ($option->values as $value) {
                        $valueModel = $optionValues->first(fn ($val) => $value == $val->translate('name'));

                        if (! $valueModel) {
                            $valueModel = ProductOptionValue::create([
                                'product_option_id' => $optionModel->id,
                                'name' => [
                                    'en' => $value,
                                ],
                            ]);
                        }

                        $optionValueIds[] = $valueModel->id;
                    }
                }
                GenerateVariants::dispatch($productModel, $optionValueIds);
            });
        });
    }
}
