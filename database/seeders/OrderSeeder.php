<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Lunar\Base\OrderReferenceGenerator;
use Lunar\Base\ValueObjects\Cart\TaxBreakdown;
use Lunar\Base\ValueObjects\Cart\TaxBreakdownAmount;
use Lunar\DataTypes\Price;
use Lunar\Facades\Pricing;
use Lunar\Models\Channel;
use Lunar\Models\Currency;
use Lunar\Models\Order;
use Lunar\Models\OrderAddress;
use Lunar\Models\ProductVariant;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $variants = ProductVariant::get();
            $users = User::get();
            $faker = Factory::create();
            $channel = Channel::getDefault();
            $currency = Currency::getDefault();

            $cardTypes = ['visa', 'mastercard'];

            for ($i = 0; $i < 201; $i++) {
                $generator = app(OrderReferenceGenerator::class);

                $itemModels = $variants->shuffle()->take($faker->numberBetween(1, 15));

                $lines = collect();

                foreach ($itemModels as $variant) {
                    $quantity = $faker->numberBetween(1, 10);

                    $pricing = Pricing::for($variant, $quantity)->get();
                    $price = $pricing->matched->price->value;
                    $subTotal = $price * $quantity;
                    $tax = (int) ($subTotal * .2);
                    $options = $variant->values->map(fn ($value) => $value->translate('name'));

                    $lines->push([
                        'quantity' => $quantity,
                        'purchasable_type' => ProductVariant::class,
                        'purchasable_id' => $variant->id,
                        'type' => 'physical',
                        'description' => $variant->product->translateAttribute('name'),
                        'option' => $options->join(', '),
                        'identifier' => $variant->sku,
                        'unit_price' => $price,
                        'unit_quantity' => $variant->unit_quantity,
                        'sub_total' => $subTotal,
                        'discount_total' => 0,
                        'tax_total' => $tax,
                        'total' => $subTotal + $tax,
                        'tax_breakdown' => new TaxBreakdown(collect([
                            new TaxBreakdownAmount(
                                price: new Price($tax, $currency, 1),
                                identifier: 'VAT',
                                description: 'VAT',
                                percentage: 20,
                            )
                        ]))
                    ]);
                }

                // Is this for a user?
                $hasUser = $faker->boolean(75);

                $order = [
                    'channel_id' => $channel->id,
                    'status' => 'payment-received',
                    'sub_total' => $lines->sum('sub_total'),
                    'reference' => null,
                    'tax_total' => $lines->sum('tax_total'),
                    'total' => $lines->sum('total'),
                    'currency_code' => $currency->code,
                    'placed_at' => $faker->dateTimeBetween('-1 year'),
                    'compare_currency_code' => $currency->code,
                    'meta' => [],
                    'tax_breakdown' => new TaxBreakdown(collect([
                        new TaxBreakdownAmount(
                            price: new Price($lines->sum('tax_total'), $currency, 1),
                            identifier: 'VAT',
                            description: 'VAT',
                            percentage: 20,
                        )
                    ]))
                ];

                if ($hasUser) {
                    $user = $users->shuffle()->first();

                    $order['customer_id'] = $user->customers->first()?->id;
                    $order['user_id'] = $user->id;
                }

                $orderModel = Order::factory()->create($order);

                $orderModel->reference = $generator->generate($orderModel);
                $orderModel->save();

                // Shipping / Billing address
                $shipping = OrderAddress::factory()->create([
                    'order_id' => $orderModel->id,
                    'type' => 'shipping',
                    'country_id' => 235, // UK
                ]);

                if ($faker->boolean()) {
                    $shippingAdd = $shipping->toArray();
                    unset($shippingAdd['id']);
                    $shippingAdd['type'] = 'billing';
                    OrderAddress::factory()->create($shippingAdd);
                } else {
                    OrderAddress::factory()->create([
                        'order_id' => $orderModel->id,
                        'type' => 'billing',
                        'country_id' => 235, // UK
                    ]);
                }

                $orderModel->lines()->createMany($lines->toArray());
            }
        });
    }
}
