<?php

declare(strict_types=1);

namespace App\Actions\Resources;

use App\Contracts\Actions\Resources\ProvidesArticleResource;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Wink\WinkPost;

final class ProvideArticleResource implements ProvidesArticleResource
{
    public function handle(WinkPost $article, Request $request): array
    {
        return ArticleResource::make($article)->forInertia($request);
    }
}
