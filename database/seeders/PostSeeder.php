<?php

namespace Database\Seeders;

use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Wink\WinkTag;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        PostFactory::new()->count(10)->create();
        PostFactory::new()->count(30)->hasTags($this->tag('blog'))->create();
        PostFactory::new()->count(5)->hasTags($this->tag('blog'))->unpublished()->create();
    }

    private function tag(string $slug): WinkTag
    {
        return WinkTag::query()->firstOrCreate(['slug' => $slug], [
            'name' => Str::title($slug),
        ]);
    }
}
