<?php

namespace Database\Seeders;

use GetCandy\FieldTypes\Text;
use GetCandy\FieldTypes\TranslatedText;
use GetCandy\Models\Collection;
use GetCandy\Models\CollectionGroup;
use GetCandy\Models\Language;
use GetCandy\Models\Url;
use Illuminate\Database\Seeder;
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

        $defaultLanguage = Language::getDefault();

        DB::transaction(function () use ($collections, $defaultLanguage) {
            foreach ($collections as $collection) {
                $model = Collection::create([
                    'collection_group_id' => CollectionGroup::first()->id,
                    'attribute_data' =>  [
                        'name' => new TranslatedText([
                            'en' => new Text($collection->name)
                        ]),
                    ]
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
