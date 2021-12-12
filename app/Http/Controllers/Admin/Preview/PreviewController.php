<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Preview;

use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Wink\WinkPost;

final class PreviewController extends Controller
{
    public function __invoke(Request $request, WinkPost $post, ProvidesPostResource $postResourceProvider): Response
    {
        return Inertia::render('Post', [
            'post' => $postResourceProvider->for($post, $request),
            'preview' => true,
        ]);
    }
}
