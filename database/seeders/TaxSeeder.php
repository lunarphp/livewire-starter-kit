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
        /**
         * Tax Zones.
         */
        $ukTaxZone = TaxZone::factory()->create([
            'name' => 'UK',
            'zone_type' => 'country',
            'default' => true,
            'active' => true,
        ]);

        $uk = Country::where('iso3', '=', 'GBR')->first();

        TaxZoneCountry::factory()->create([
            'country_id' => $uk->id,
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
                'tax_class_id' => TaxClass::first()->id,
            ],
        ]);
    }
}
