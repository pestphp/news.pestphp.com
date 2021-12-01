<?php

declare(strict_types=1);

namespace App\Actions\Models\LoadRelatedPosts;

use App\Contracts\Actions\Models\LoadsRelatedPosts;
use Illuminate\Database\Eloquent\Builder;
use Wink\WinkPost;

final class LoadRelatedPublishedPosts implements LoadsRelatedPosts
{
    public function __construct(private LoadsRelatedPosts $decoratedAction)
    {
    }

    public function handle(WinkPost $post): Builder
    {
        return $this->decoratedAction
            ->handle($post)
            ->published();
    }
}
