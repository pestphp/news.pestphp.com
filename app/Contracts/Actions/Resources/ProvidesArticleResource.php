<?php

declare(strict_types=1);

namespace App\Contracts\Actions\Resources;

use Illuminate\Http\Request;
use Wink\WinkPost;

interface ProvidesArticleResource
{
    /**
     * @return array<string, mixed>
     */
    public function handle(WinkPost $article, Request $request): array;
}
