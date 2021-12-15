<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Models\LoadPosts\LoadPostsByTag;
use App\Actions\Models\LoadPosts\LoadPublishedPosts;
use App\Actions\Models\LoadPosts\LoadRelatedPosts;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCode;
use Wink\WinkPost;

final class PostController extends Controller
{
    public function __construct(
        private ProvidesPostResource $postResourceProvider
    ) {
    }

    public function index(Request $request): Response
    {
        $data = ['tags' => $request->get('tags', [])];

        $posts = $this
            ->publishedPosts((new LoadPostsByTag($data))->handle())
            ->paginate(12)
            ->through(fn (WinkPost $post) => $this->postResourceProvider->for($post, $request));

        return Inertia::render('Blog', ['posts' => $posts]);
    }

    public function show(Request $request, WinkPost $post): Response
    {
        abort_unless($post->published, ResponseCode::HTTP_NOT_FOUND);

        abort_if($post->publish_date->isFuture(), ResponseCode::HTTP_NOT_FOUND);

        $relatedPosts = $this->publishedPosts((new LoadRelatedPosts($post))->handle())
            ->limit(3)
            ->get();

        return Inertia::render('Post', [
            'post' => $this->postResourceProvider->for($post, $request),
            'related_posts' => $this->postResourceProvider->forAll($relatedPosts, $request),
        ]);
    }

    /**
     * @param Builder<WinkPost>|null $winkPostBuilder
     *
     * @return Builder<WinkPost>
     */
    private function publishedPosts(Builder $winkPostBuilder = null): Builder
    {
        return (new LoadPublishedPosts($winkPostBuilder))->handle();
    }
}
