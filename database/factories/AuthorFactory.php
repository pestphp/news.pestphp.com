<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Wink\WinkAuthor;

class AuthorFactory extends Factory
{
    protected $model = WinkAuthor::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->uuid,
            'slug' => $this->faker->unique()->slug,
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->name,
            'password' => '$2y$10$47QqryzwI4cmaKfqgCOZfe4BkcGsi1BKvwDkySmQe1svSfoWGuCY6',
            'bio' => $this->faker->paragraph,
        ];
    }
}
