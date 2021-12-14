<?php

declare(strict_types=1);

use App\Actions\Models\LoadPosts\LoadPublishedPosts;
use Wink\WinkPost;

it('loads a builder limited to published, live posts', function () {
    // Create a few posts, one published, the other scheduled, the other unpublished
    post()->create();
    post()->scheduled()->create();
    post()->unpublished()->create();

    $action = new LoadPublishedPosts(WinkPost::query());
    $posts = $action->handle()->get();

    // Only one post is actually available, because only one post is published
    expect($posts)->toHaveCount(1);
});
