<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Preview;

use App\Actions\Models\LoadPosts\LoadRelatedPublishedPostsAsProphet;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Wink\WinkPost;

final class PreviewController extends Controller
{
    public function __construct(private ProvidesPostResource $postResourceProvider)
    {
    }

    public function __invoke(Request $request, WinkPost $post): Response
    {
        $relatedPosts = (new LoadRelatedPublishedPostsAsProphet($post))->handle()->limit(3)->get();

        return Inertia::render('Posts/Show', [
            'post' => $this->postResourceProvider->for($post, $request),
            'related_posts' => $this->postResourceProvider->forAll($relatedPosts, $request),
            'preview' => true,
        ]);
    }
}
