<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Preview;

use App\Contracts\Actions\Models\LoadsRelatedPosts;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Wink\WinkPost;

final class PreviewController extends Controller
{
    public function __construct(
        private ProvidesPostResource $postResourceProvider,
        private LoadsRelatedPosts $relatedPostLoader,
    ) {
    }

    public function __invoke(Request $request, WinkPost $post): Response
    {
        $relatedPosts = $this->relatedPostLoader->handle($post)->limit(3)->get();

        return Inertia::render('Post', [
            'post' => $this->postResourceProvider->for($post, $request),
            'related_posts' => $this->postResourceProvider->forAll($relatedPosts, $request),
            'preview' => true,
        ]);
    }
}
