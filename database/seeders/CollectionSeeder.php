<?php

namespace Database\Seeders;

use GetCandy\FieldTypes\Text;
use GetCandy\FieldTypes\TranslatedText;
use GetCandy\Models\Collection;
use GetCandy\Models\CollectionGroup;
use GetCandy\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CollectionSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = $this->getSeedData('collections');

        $collectionGroup = CollectionGroup::factory()->create();

        $defaultLanguage = Language::factory()->create();

        DB::transaction(function () use ($collections, $collectionGroup, $defaultLanguage) {
            foreach ($collections as $collection) {
                $model = Collection::create([
                    'collection_group_id' => $collectionGroup->id,
                    'attribute_data' =>  [
                        'name' => new TranslatedText([
                            'en' => new Text($collection->name),
                        ]),
                        'description' => new TranslatedText([
                            'en' => new Text($collection->description),
                        ]),
                    ],
                ]);

                $model->urls()->create([
                    'slug' => Str::slug($collection->name),
                    'default' => true,
                    'language_id' => $defaultLanguage->id,
                ]);
            }
        });
    }
}
