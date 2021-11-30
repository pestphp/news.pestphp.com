<?php

declare(strict_types=1);

namespace App\Actions\Resources;

use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Wink\WinkPost;

final class ProvidePostResource implements ProvidesPostResource
{
    public function handle(WinkPost $post, Request $request): array
    {
        return PostResource::make($post)->forInertia($request);
    }
}
