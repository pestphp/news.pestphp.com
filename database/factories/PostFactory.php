<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Wink\WinkAuthor;
use Wink\WinkPost;

class PostFactory extends Factory
{
    protected $model = WinkPost::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique->uuid,
            'slug' => $this->faker->unique->slug,
            'title' => $this->faker->sentence,
            'excerpt' => fn (array $attributes) => Str::limit($attributes['body'], 80),
            'body' => $this->faker->paragraphs(5, true),
            'published' => true,
            'publish_date' => now()->subDay(),
            'featured_image_caption' => '',
            'author_id' => AuthorFactory::new(),
        ];
    }

    public function forAuthor(AuthorFactory|WinkAuthor $author): self
    {
        return $this->for($author, 'author');
    }
}
