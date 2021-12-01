<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Wink\WinkTag;

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
}
