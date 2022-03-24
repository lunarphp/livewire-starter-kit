<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
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
        DB::transaction(function () {
            $faker = Factory::create();
            $customers = Customer::factory(100)->create();
            foreach ($customers as $customer) {
                // Add some users...
                for ($i=0; $i < $faker->numberBetween(1, 10); $i++) {
                    $user = User::factory()->create();
                    $customer->users()->attach($user);
                }
            }
        });
    }
}
