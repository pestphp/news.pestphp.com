<?php

namespace Database\Seeders;

use Database\Factories\AuthorFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Seeder;
use Wink\WinkAuthor;

class DatabaseSeeder extends Seeder
{
    public function run(Application $app): void
    {
        WinkAuthor::query()->delete();

        if ($app->environment('local')) {
            AuthorFactory::new()->create(['email' => 'luke@downing.tech']);
        }

        // @phpstan-ignore-next-line
        $this->resolve(EmailListSeeder::class)->run();
        // @phpstan-ignore-next-line
        $this->resolve(TagSeeder::class)->run();

        if (app()->environment('local')) {
            // @phpstan-ignore-next-line
            $this->resolve(PostSeeder::class)->run();
        }
    }
}
