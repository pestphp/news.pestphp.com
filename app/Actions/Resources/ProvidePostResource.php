<?php

declare(strict_types=1);

namespace App\Actions\Resources;

use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Enumerable;
use Wink\WinkPost;

final class ProvidePostResource implements ProvidesPostResource
{
    public function for(WinkPost $post, Request $request): array
    {
        return PostResource::make($post)->forInertia($request);
    }

    public function forAll(Enumerable $posts, Request $request): array
    {
        return PostResource::collection($posts)->toResponse($request)->getData(true);
    }
}
