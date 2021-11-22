<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Preview;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Inertia\Response;
use Wink\WinkPost;

final class PreviewController extends Controller
{
    public function __invoke(Request $request, WinkPost $article): Response
    {
        return inertia('Article', [
            'article' => ArticleResource::make($article)->forInertia($request),
        ]);
    }
}
