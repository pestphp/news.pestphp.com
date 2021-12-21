<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Wink\WinkTag;

/**
 * @extends Factory<WinkTag>
 */
class TagFactory extends Factory
{
    protected $model = WinkTag::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->uuid,
            'slug' => $this->faker->unique()->slug,
            'name' => $this->faker->word,
        ];
    }

    public function blog(): WinkTag
    {
        // @phpstan-ignore-next-line
        return $this->create(['name' => 'Blog', 'slug' => 'blog']);
    }
}
