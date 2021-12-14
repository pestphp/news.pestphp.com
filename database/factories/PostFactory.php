<?php

namespace Database\Factories;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Wink\WinkAuthor;
use Wink\WinkPost;
use Wink\WinkTag;

/**
 * @extends Factory<WinkPost>
 */
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

    public function scheduled(CarbonInterface $publishDate = null): self
    {
        return $this->state([
            'published' => true,
            'publish_date' => $publishDate ?? now()->addDay(),
        ]);
    }

    public function unpublished(CarbonInterface $publishDate = null): self
    {
        return $this->state([
            'published' => false,
            'publish_date' => $publishDate ?? now()->addDay(),
        ]);
    }

    /**
     * @param TagFactory|Collection<WinkTag>|WinkTag|int $tags
     */
    public function hasTags(TagFactory|Collection|WinkTag|int $tags): self
    {
        if (is_int($tags)) {
            $tags = TagFactory::new()->count($tags);
        }

        return $this->hasAttached($tags, [], 'tags');
    }

    public function withRelatedPosts(int $count): self
    {
        $tag = TagFactory::new()->create();

        return $this->hasTags($tag)->afterCreating(function () use ($count, $tag) {
            static::count($count)->hasTags($tag)->create();
        });
    }
}
