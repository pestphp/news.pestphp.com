<?php

declare(strict_types=1);

use App\Actions\Models\LoadPosts\LoadRelatedPublishedPostsAsProphet;

it('loads a builder limited to the related posts of a post that will be published by the time the post is published', function () {
    $tag = tag()->create();
    $post = post()->unpublished(now()->addMonth())->hasTags($tag)->create();

    // Create a few of related posts, one published yesterday, another in a week, another published in 2 months
    post()->hasTags($tag)->create(['publish_date' => now()->subDay()]);
    post()->unpublished(now()->addWeek())->hasTags($tag)->create();
    post()->unpublished(now()->addMonths(2))->hasTags($tag)->create();

    $action = new LoadRelatedPublishedPostsAsProphet($post);
    $posts = $action->handle()->get();

    // Only two related posts are actually available, the one in the past and the one in a week.
    // The other is too far into the future.
    expect($posts)->toHaveCount(2);
});

it('falls back to LoadRelatedPublishedPosts if the publish_date is past', function () {
    $tag = tag()->create();
    $post = post()->hasTags($tag)->create(['publish_date' => now()->subWeek()]);

    // 2 related posts, published but after the parent post
    post()->count(2)->hasTags($tag)->create();
    // A post that isn't published yet so still shouldn't appear in the results
    post()->hasTags($tag)->unpublished()->create();

    $action = new LoadRelatedPublishedPostsAsProphet($post);
    $posts = $action->handle()->get();

    expect($posts)->toHaveCount(2);
});
