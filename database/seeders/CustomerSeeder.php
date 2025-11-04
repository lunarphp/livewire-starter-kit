<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Lunar\Models\Address;
use Lunar\Models\Customer;
use Lunar\Models\Country;

class CustomerSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        DB::transaction(function () {
            $faker = Factory::create();
            $customers = Customer::factory(100)->create();

            // Get the first available country, or create one if none exists
            $country = Country::first();
            if (!$country) {
                $country = Country::factory()->create([
                    'name' => 'United Kingdom',
                    'iso3' => 'GBR',
                    'iso2' => 'GB',
                ]);
            }

            foreach ($customers as $customer) {
                for ($i = 0; $i < $faker->numberBetween(1, 10); $i++) {
                    $user = User::factory()->create();

                    $customer->users()->attach($user);
                }

                Address::factory()->create([
                    'shipping_default' => true,
                    'country_id' => $country->id,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'country_id' => $country->id,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'billing_default' => true,
                    'country_id' => $country->id,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'billing_default' => false,
                    'country_id' => $country->id,
                    'customer_id' => $customer->id,
                ]);
            }
        });
    }
}
