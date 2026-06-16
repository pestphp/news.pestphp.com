<?php

namespace Database\Seeders;

use Database\Factories\AuthorFactory;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Wink\WinkAuthor;
use Wink\WinkTag;

class PostSeeder extends Seeder
{
    private ?WinkAuthor $author = null;

    public function forAuthor(WinkAuthor $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function run(): void
    {
        /** @var WinkAuthor $author */
        $author = $this->author ?? AuthorFactory::new()->create();

        PostFactory::new()->count(10)->for($author, 'author')->create();
        PostFactory::new()->count(30)->for($author, 'author')->hasTags($this->tag('blog'))->create();
        PostFactory::new()->count(5)->for($author, 'author')->hasTags($this->tag('blog'))->unpublished()->create();
    }

    private function tag(string $slug): WinkTag
    {
        return WinkTag::query()->firstOrCreate(['slug' => $slug], [
            'name' => Str::title($slug),
        ]);
    }
}
