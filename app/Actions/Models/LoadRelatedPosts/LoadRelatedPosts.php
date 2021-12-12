<?php

declare(strict_types=1);

namespace App\Actions\Models\LoadRelatedPosts;

use App\Contracts\Actions\Models\LoadsRelatedPosts;
use Illuminate\Database\Eloquent\Builder;
use Wink\WinkPost;

/**
 * A post is classed as "related" to another post if the two posts share at
 * least one tag. Note that this action will not decide whether the posts
 * should be published or unpublished. You should instead use one of
 * the available decorator LoadsRelatedPosts actions to decide that.
 */
final class LoadRelatedPosts implements LoadsRelatedPosts
{
    public function handle(WinkPost $post): Builder
    {
        return WinkPost::query()
            ->with('author')
            ->whereKeyNot($post->getKey())
            ->whereHas('tags', fn (Builder $query) => $query->whereIn('id', $post->tags()->pluck('id')))
            ->orderByDesc('publish_date');
    }
}
