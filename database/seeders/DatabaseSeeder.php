<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CollectionSeeder::class);
        // $this->call(AttributeSeeder::class);
        // $this->call(TaxSeeder::class);
        // $this->call(ProductSeeder::class);
        $this->call(CustomerSeeder::class);
        // $this->call(OrderSeeder::class);
    }
}
