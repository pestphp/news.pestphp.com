<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Models\LoadPosts\LoadPublishedPosts;
use App\Contracts\Actions\Resources\ProvidesPostResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Wink\WinkPost;

final class HomeController extends Controller
{
    public function __construct(private ProvidesPostResource $postResourceProvider)
    {
    }

    public function __invoke(Request $request): Response
    {
        $posts = fn () => (new LoadPublishedPosts())
            ->handle()
            ->paginate(12)
            ->through(fn (WinkPost $post) => $this->postResourceProvider->for($post, $request));

        return Inertia::render('Home', [
            'posts' => $posts,
        ]);
    }
}
