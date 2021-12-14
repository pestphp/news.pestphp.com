<?php

declare(strict_types=1);

namespace App\Actions\Models\LoadPosts;

use App\Contracts\Actions\Models\LoadsPosts;
use Illuminate\Database\Eloquent\Builder;
use Wink\WinkPost;

final class LoadPublishedPosts implements LoadsPosts
{
    /**
     * @param Builder<WinkPost> $builder
     */
    public function __construct(private Builder $builder)
    {
    }

    public function handle(): Builder
    {
        return $this->builder
            ->published()
            ->live();
    }
}
