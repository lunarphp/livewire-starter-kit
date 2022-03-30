<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use GetCandy\Models\Address;
use GetCandy\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $country = Country::
        DB::transaction(function () {
            $faker = Factory::create();
            $customers = Customer::get();
            foreach ($customers as $customer) {
                // Add some users...
                // for ($i=0; $i < $faker->numberBetween(1, 10); $i++) {
                //     $user = User::factory()->create();
                //     $customer->users()->attach($user);
                // }

                // Add a billing and shipping address.
                Address::factory()->create([
                    'shipping_default' => true,
                    'country_id' => 235,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'country_id' => 235,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'billing_default' => true,
                    'country_id' => 235,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'billing_default' => false,
                    'country_id' => 235,
                    'customer_id' => $customer->id,
                ]);
            }
        });
    }
}
