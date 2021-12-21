<?php

declare(strict_types=1);

use App\Actions\Models\LoadPosts\LoadPosts;

it('loads all types of post ordered by most recent', function () {
    $pastPost = post()->create(['publish_date' => now()->subYear()]);
    $publishedPost = post()->create();
    $scheduledPost = post()->scheduled()->create();
    $futurePost = post()->unpublished(now()->addWeek())->create();

    $action = new LoadPosts();

    expect($action->handle()->get())
        ->toHaveCount(4)
        ->first()->is($futurePost)->toBeTrue()
        ->last()->is($pastPost)->toBeTrue();
});
