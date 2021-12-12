<?php

declare(strict_types=1);

namespace App\Contracts\Actions\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Enumerable;
use Wink\WinkPost;

interface ProvidesPostResource
{
    /**
     * @return array<string, mixed>
     */
    public function for(WinkPost $post, Request $request): array;

    /**
     * @param Enumerable<WinkPost> $posts
     *
     * @return array<int, array<string, mixed>>
     */
    public function forAll(Enumerable $posts, Request $request): array;
}
