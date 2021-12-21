<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Wink\WinkTag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        WinkTag::query()->updateOrCreate(['slug' => 'blog'], [
            'id' => Str::uuid(),
            'name' => 'Blog',
        ]);
    }
}
