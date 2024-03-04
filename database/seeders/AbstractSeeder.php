<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

abstract class AbstractSeeder extends Seeder
{
    protected function getSeedData($file): Collection
    {
        return collect(json_decode(
            File::get(
                base_path("database/seeders/data/{$file}.json")
            )
        ));
    }
}
