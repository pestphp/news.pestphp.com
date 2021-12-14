<?php

declare(strict_types=1);

use App\Actions\Models\LoadPosts\LoadRelatedPosts;

it('loads a builder limited to the related posts of a post', function () {
    $tags = tag()->count(2)->create();
    $post = post()->hasTags($tags)->create();

    // Create a couple of related posts, one published, the other not
    post()->hasTags($tags->take(1))->create();
    post()->unpublished()->hasTags($tags->skip(1)->take(1))->create();

    // And some unrelated posts
    post()->count(3)->hasTags(4)->create();

    $action = new LoadRelatedPosts($post);
    $posts = $action->handle()->get();

    expect($posts)->toHaveCount(2);
});
