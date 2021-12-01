<?php

declare(strict_types=1);

use App\Actions\Models\LoadRelatedPosts\LoadRelatedPublishedPosts;

it('loads a builder limited to the related published posts of a post', function () {
    $tags = tag()->count(2)->create();
    $post = post()->hasTags($tags)->create();

    // Create a couple of related posts, one published, the other not
    post()->hasTags($tags->take(1))->create();
    post()->unpublished()->hasTags($tags->skip(1)->take(1))->create();

    $action = $this->app->make(LoadRelatedPublishedPosts::class);
    $posts = $action->handle($post)->get();

    // Only one related post is actually available, because only one related post is published
    expect($posts)->toHaveCount(1);
});
