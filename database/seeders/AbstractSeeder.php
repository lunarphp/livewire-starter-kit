<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

abstract class AbstractSeeder extends Seeder
{
    protected function getSeedData($file)
    {
        return collect(json_decode(
            File::get(
                base_path("database/seeders/data/{$file}.json")
            )
        ));
    }
}
