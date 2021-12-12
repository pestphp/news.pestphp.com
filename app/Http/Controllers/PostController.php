<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Actions\Resources\ProvidesPostResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCode;
use Wink\WinkPost;

final class PostController extends Controller
{
    public function show(Request $request, WinkPost $post, ProvidesPostResource $postResourceProvider): Response
    {
        abort_unless($post->published, ResponseCode::HTTP_NOT_FOUND);

        abort_if($post->publish_date->isFuture(), ResponseCode::HTTP_NOT_FOUND);

        return Inertia::render('Post', [
            'post' => $postResourceProvider->for($post, $request),
        ]);
    }
}
