<?php

declare(strict_types=1);

namespace App\Actions\Models\LoadPosts;

use App\Contracts\Actions\Models\LoadsPosts;
use Illuminate\Database\Eloquent\Builder;
use Wink\WinkPost;

/**
 * Unlike LoadPublishedPosts, this decorator will return posts that
 * will be published by the time the subject post is published.
 * This is useful for previewing a scheduled post.
 */
final class LoadRelatedPublishedPostsAsProphet implements LoadsPosts
{
    public function __construct(private WinkPost $post)
    {
    }

    public function handle(): Builder
    {
        return $this->post->publish_date->isPast()
            ? (new LoadPublishedPosts($this->getRelatedPostsBuilder()))->handle()
            : $this->getRelatedPostsBuilder()->beforePublishDate($this->post->publish_date);
    }

    /**
     * @return Builder<WinkPost>
     */
    private function getRelatedPostsBuilder(): Builder
    {
        return (new LoadRelatedPosts($this->post))->handle();
    }
}
