<?php

declare(strict_types=1);

namespace App\Actions\Models\LoadRelatedPosts;

use App\Contracts\Actions\Models\LoadsRelatedPosts;
use Illuminate\Database\Eloquent\Builder;
use Wink\WinkPost;

/**
 * Unlike LoadRelatedPublishedPosts, this decorator will return posts
 * that will be published by the time the parent post is published.
 * This is useful for previewing the state of an upcoming post.
 */
final class LoadRelatedPublishedPostsAsProphet implements LoadsRelatedPosts
{
    public function __construct(
        private LoadsRelatedPosts $decoratedAction,
        private LoadRelatedPublishedPosts $fallbackAction,
    ) {
    }

    public function handle(WinkPost $post): Builder
    {
        return $post->publish_date->isPast()
            ? $this->fallbackAction->handle($post)
            : $this->decoratedAction->handle($post)->beforePublishDate($post->publish_date);
    }
}
