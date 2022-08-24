<?php

namespace Database\Seeders;

use Database\Seeders\AbstractSeeder;
use GetCandy\FieldTypes\ListField;
use GetCandy\FieldTypes\Text;
use GetCandy\FieldTypes\TranslatedText;
use GetCandy\Hub\Jobs\Products\GenerateVariants;
use GetCandy\Models\Attribute;
use GetCandy\Models\Collection;
use GetCandy\Models\Currency;
use GetCandy\Models\Language;
use GetCandy\Models\Price;
use GetCandy\Models\Product;
use GetCandy\Models\ProductOption;
use GetCandy\Models\ProductOptionValue;
use GetCandy\Models\ProductType;
use GetCandy\Models\ProductVariant;
use GetCandy\Models\TaxClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        DB::transaction(function () use ($products, $attributes, $productType, $taxClass, $currency, $collections, $language) {
            $products->each(function ($product) use ($attributes, $productType, $taxClass, $currency, $collections, $language) {
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

                $productModel = Product::create([
                    'attribute_data' => $attributeData,
                    'product_type_id' => $productType->id,
                    'status' => 'published',
                    'brand' => $product->brand,
                ]);

                $variant = ProductVariant::create([
                    'product_id' => $productModel->id,
                    'purchasable' => 'always',
                    'shippable' => true,
                    'stock' => 0,
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
