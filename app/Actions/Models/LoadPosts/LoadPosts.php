<?php

declare(strict_types=1);

namespace App\Actions\Models\LoadPosts;

use App\Contracts\Actions\Models\LoadsPosts;
use Illuminate\Database\Eloquent\Builder;
use Wink\WinkPost;

final class LoadPosts implements LoadsPosts
{
    public function handle(): Builder
    {
        return WinkPost::query()
            ->with('author')
            ->orderByDesc('publish_date');
    }
}
