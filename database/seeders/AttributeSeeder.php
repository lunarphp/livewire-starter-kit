<?php

namespace Database\Seeders;

use GetCandy\FieldTypes\Text;
use GetCandy\FieldTypes\TranslatedText;
use GetCandy\Models\Attribute;
use GetCandy\Models\AttributeGroup;
use GetCandy\Models\Collection;
use GetCandy\Models\CollectionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = $this->getSeedData('attributes');

        $group = AttributeGroup::first();

        DB::transaction(function () use ($attributes, $group) {
            foreach ($attributes as $attribute) {
                Attribute::create([
                    'attribute_group_id' => $group->id,
                    'attribute_type' => $attribute->attribute_type,
                    'handle' => Str::snake($attribute->name),
                    'section' => 'main',
                    'type' => $attribute->type,
                    'required' => false,
                    'searchable' => true,
                    'filterable' => false,
                    'system' => false,
                    'position' => $group->attributes()->count() + 1,
                    'name' => [
                        'en' => $attribute->name,
                    ],
                    'configuration' => (array) $attribute->configuration,
                ]);
            }
        });
    }
}
