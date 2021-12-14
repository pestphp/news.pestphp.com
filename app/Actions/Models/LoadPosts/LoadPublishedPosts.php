<?php

declare(strict_types=1);

namespace App\Actions\Models\LoadPosts;

use App\Contracts\Actions\Models\LoadsPosts;
use Illuminate\Database\Eloquent\Builder;
use Wink\WinkPost;

final class LoadPublishedPosts implements LoadsPosts
{
    /**
     * @var Builder<WinkPost>
     */
    private Builder $builder;

    /**
     * @param ?Builder<WinkPost> $builder
     */
    public function __construct(?Builder $builder = null)
    {
        $this->builder = $builder ?? (new LoadPosts())->handle();
    }

    public function handle(): Builder
    {
        return $this->builder
            ->published()
            ->live();
    }
}
