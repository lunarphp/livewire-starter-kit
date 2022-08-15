<?php

namespace Database\Seeders;

use GetCandy\Models\Country;
use GetCandy\Models\TaxClass;
use GetCandy\Models\TaxRate;
use GetCandy\Models\TaxZone;
use GetCandy\Models\TaxZoneCountry;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $taxClass = TaxClass::factory()->create([
            'default' => true,
        ]);

        $ukCountry = Country::firstWhere('iso3', 'GBR');

        $ukTaxZone = TaxZone::factory()->create([
            'name' => 'UK',
            'active' => true,
            'default' => true,
            'zone_type' => 'country',
        ]);

        TaxZoneCountry::factory()->create([
            'country_id' => $ukCountry->id,
            'tax_zone_id' => $ukTaxZone->id,
        ]);

        $ukRate = TaxRate::factory()->create([
            'name' => 'VAT',
            'tax_zone_id' => $ukTaxZone->id,
            'priority' => 1,
        ]);

        $ukRate->taxRateAmounts()->createMany([
            [
                'percentage' => 20,
                'tax_class_id' => $taxClass->id,
            ],
        ]);
    }
}
